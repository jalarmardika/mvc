<?php 
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {

	public function index()
	{
		$this->view('template/header', [
			"title" => "Home Page"
		]);
		$this->view('home/index', [
			"name" => "Jalar Mardika"
		]);
		$this->view('template/footer');
	}
	public function about()
	{
		$this->view('template/header', [
			"title" => "About Page"
		]);
		$this->view('home/about', [
			"name" => "Jalar Mardika",
			"profession" => "Web Developer"
		]);
		$this->view('template/footer');
	}

}