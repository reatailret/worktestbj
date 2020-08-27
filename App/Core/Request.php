<?php
namespace Worktest\Core;
/**
 * Request interface, $_GET,$_POST wraper
 */
class Request
{
    /**
     * Get var from $_GET
     *
     * @param string $key
     * @param boolean $default
     * @return mixed
     */
    public function get(string $key, $default = false)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get var from $_POST
     *
     * @param string $key
     * @param boolean $default
     * @return mixed
     */
    public function post(string $key, $default = false)
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Get all $_GET
     *
     * @param string $key
     * @return array
     */
    public function postAll()
    {
        return $_POST;
    }
}
