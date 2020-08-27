<?php
namespace Worktest\Core;

class Request
{
    public function get(string $key, $default = false)
    {
        return $_GET[$key] ?? $default;
    }
    public function post(string $key, $default = false)
    {
        return $_POST[$key] ?? $default;
    }
    public function postAll()
    {
        return $_POST;
    }
}
