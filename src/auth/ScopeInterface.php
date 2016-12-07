<?php
/**
 * Created by PhpStorm.
 * User: ratnadeep
 * Date: 16/11/16
 * Time: 11:33 PM
 */

namespace LightPHP\Auth;


/**
 * Gives access to all available OAuth Scopes supported by an atlas platform.
 */
interface ScopeInterface
{
    /**
     * @return string[] array of strings, where each string is a scope. Scopes should match <code>^[a-zA-Z0-9_]+$</code>
     */
    public function allScopes();

    /**
     * @return string default scope. If nothing else is specified in an API endpoint, this scope will be  required to access
     * the controller.
     */
    public function defaultScope();
}