<?php

namespace Core;

class Request
{
    private $headers;
    private $body;
    private $method;
    private $uri;

    public function __construct()
    {
        $this->headers = getallheaders();
        $this->body = json_decode(file_get_contents('php://input'), true);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
