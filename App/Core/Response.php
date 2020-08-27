<?php
namespace Worktest\Core;
/**
 * Response interface
 */
class Response
{
    private $content = '';
    
    /**
     * Send otput
     *
     * @return void
     */
    public function send()
    {
        echo $this->content;
    }

    /**
     * Send status code and stop
     *
     * @param integer $code
     * @return void
     */
    public function abort(int $code)
    {
        http_response_code($code);
        exit();
    }

    /**
     * Set content
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
