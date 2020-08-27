<?php
namespace Worktest\Core;

class Response
{
    private $content = '';
    public function send()
    {
        echo $this->content;
    }
    public function abort(int $code)
    {
        http_response_code($code);
        exit();
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
