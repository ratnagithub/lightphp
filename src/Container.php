<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 13/11/16
 * Time: 10:24 PM
 */

namespace LightPHP;


use Dice\Dice;
use LightPHP\Auth\Auth;
use LightPHP\Auth\ScopeInterface;
use LightPHP\Exceptions\IOException;
use LightPHP\Utils\Configuration;
use LightPHP\Utils\Filesystem\Directory;
use LightPHP\Utils\MemoryCache;
use LightPHP\Utils\Resources;
use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\UserCredentialsInterface;

class Container
{
    private $services;


    private $cacheKey = 'services';

    private $config;

    private $projectDirectory;

    public function __construct()
    {
        $this->projectDirectory = dirname(getcwd());
        $this->config = new Configuration(new Resources(new Directory($this->projectDirectory)));
        $this->setAllServices();
    }

    public function get(string $serviceName)
    {
        return !empty($this->services[$serviceName]) ? $this->services[$serviceName] : null;
    }

    protected function setAllServices()
    {
        $dice = new Dice();
        $serviceList = array_merge($this->getDefaultServiceList(), $this->getClientServiceList());
        if (!empty($serviceList)) {
            foreach ($serviceList as $serviceName => $serviceDetails) {
                if (is_string($serviceDetails)) {
                    $serviceNameSpace = $serviceDetails;
                } elseif (is_array($serviceDetails)) {
                    $serviceNameSpace = $serviceDetails['class'];
                    //substitutions
                    if (!empty($serviceDetails['rules']['substitutions'])) {
                        $ruleSubstitutions = [];
                        foreach ($serviceDetails['rules']['substitutions'] as $substitutionKey => $substitutionValue) {
                            $param = !empty($substitutionValue['param']) ? $substitutionValue['param'] : null;
                            $ruleSubstitutions[$substitutionKey] = new $substitutionValue['class'] ($param);
                        }
                        $dice->addRule($serviceDetails['rules']['class'], ['substitutions' => $ruleSubstitutions]);
                    }
                } else {
                    throw new IOException('Invalid service type');
                }
                $services[$serviceName] = $dice->create($serviceNameSpace);
            }
        }
        $this->services = $services;
    }

    protected function getDefaultServiceList()
    {
        $resourceRules = [
            'class' => Resources::class,
            'substitutions' => [
                Directory::class => [
                    'class' => Directory::class,
                    'param' => $this->projectDirectory
                ]
            ]
        ];
        $services =  [
            'configuration' => [
                'class' => Configuration::class,
                'rules' => $resourceRules
            ],
            'resources' => [
                'class' => Resources::class,
                'rules' => $resourceRules
            ],
            'memorycache' => MemoryCache::class
        ];
        $authConfig = $this->config->get('authentication');
        if(!empty($authConfig['enabled'])) {
            $services['auth'] = [
                'class' => Auth::class,
                'rules' => [
                    'class' => Auth::class,
                    'substitutions' => [
                        ClientCredentialsInterface::class => [
                            'class' => $authConfig['ClientCredentialsInterface']
                        ],
                        UserCredentialsInterface::class => [
                            'class' => $authConfig['UserCredentialsInterface']
                        ],
                        ScopeInterface::class => [
                            'class' => $authConfig['ScopeInterface']
                        ]
                    ]
                ]
            ];
        }
        return $services;
    }

    protected function getClientServiceList()
    {
        return $this->config->get($this->cacheKey) ?: [];
    }
}