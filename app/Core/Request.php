<?php 

namespace App\Core;

class Request
{

    public array $body = [];
    public array $params = [];

    public function __construct()
    {
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $this->body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $this->body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI']; 
        $position = strpos($path, '?'); 
    
        return $position ? substr($path, 0, $position) : $path; 
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']); 
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function getParams(): array
    {
        return $this->params ?? null;
    }
    
}
