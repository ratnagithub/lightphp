<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 13/11/16
 * Time: 11:47 PM
 */

namespace LightPHP\Utils;

class MemoryCache
{
    public function get(string $keyName, callable $factory = null)
    {
        $value = apcu_fetch($keyName, $exists);
        if ($exists) {
            if (is_null($value)) {
                apcu_delete($keyName);
            }
        } else {
            if (!empty($factory) && is_callable($factory)) {
                $value = $this->set($keyName, $factory());
            } else {
                $value = null;
            }
        }
        return $value;
    }

    public function set(string $keyName, $value, int $limetimeSeconds = 0)
    {
        apcu_store($keyName, $value, $limetimeSeconds);

        return $value;
    }
}