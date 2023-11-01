<?php 

namespace App\Core;

class Request 
{

	public array $body = [];

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

	/**
	 * The getPath function in PHP retrieves the path from the current URL, excluding any query
	 * parameters.
	 * 
	 * @return the path of the current URL without any query parameters.
	 */
	public function getPath(): string
	{
		$path = $_SERVER['REQUEST_URI']; // /contact?name=John
		$position = strpos($path, '?'); // returns false if not found
	
		return $position ? substr($path, 0, $position) : $path; 
	}

	public function getMethod(): string
	{
		return strtolower($_SERVER['REQUEST_METHOD']); // GET, POST, PUT, DELETE
	}

	public function isGet(): bool
	{
		return $this->getMethod() === 'get';
	}

	public function isPost(): bool
	{
		return $this->getMethod() === 'post';
	}

	
}