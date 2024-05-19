<?php
namespace App\Core;

class Route
{
	private static $controller;
	private static $controllerMethod;
	private static array $parameter = [];
	private static array $routes = [];

	public static function get(string $uri, array $callback): void
	{
		static::add('GET', $uri, $callback);
	}

	public static function post(string $uri, array $callback): void
	{
		static::add('POST', $uri, $callback);
	}

	private static function add(string $method, string $path, array $handler): void
	{
		self::$routes[] = [
			'method' => $method,
			'path' => $path,
			'controller' => $handler[0],
			'function' => $handler[1]
		];
	}

	public static function run(): void
	{
		$url = explode('/', static::filterURL());
		$countURL = count($url);
		$valid = false;
		foreach (self::$routes as $route) {
			$path = explode('/', trim($route['path'], '/'));
			$countPath = count($path);
			if ($countPath === $countURL) {
				$same = true;
				for ($i=0; $i < $countPath; $i++) { 
					$lastIndex = strlen($path[$i]) - 1;
					if ( $path[$i][0] == "{" && $path[$i][$lastIndex] == "}" ) {
						array_push(self::$parameter, $url[$i]);
					} else {
						if ($path[$i] != $url[$i]) {
							$same = false;
							break;
						}
					}
				}

				if ($same && $_SERVER['REQUEST_METHOD'] == $route['method']) {
					$valid = true;
					self::$controller = new $route['controller'];
					self::$controllerMethod = $route['function'];
					break;
				}
			}
		}

		if ($valid) {
			call_user_func_array([self::$controller, self::$controllerMethod], self::$parameter);
		} else {
			http_response_code(404);
			exit;
		}

	}

	private static function filterURL(): string
	{
		$url = rtrim($_SERVER['QUERY_STRING'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		return $url;
	}
}