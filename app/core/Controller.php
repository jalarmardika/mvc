<?php 
namespace App\Core;

class Controller {
	public function view($view, $data = [])
	{
		if (count($data)) {
			extract($data);
		}
		require_once __DIR__ . '/../views/' . $view . '.php';
	}

	public function redirect($path)
	{
		header("location:" . BASEURL . $path);
		exit;
	}
}
