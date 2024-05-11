<?php 
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ProductController extends Controller {
	private $product;

	public function __construct()
	{
		$this->product = new Product();
	}
	public function index()
	{
		$this->view('product/index', [
			"products" => $this->product->orderBy("id", "desc")->get()
		]);
	}
	public function show($id)
	{
		$this->view('product/detail', [
			"product" => $this->product->find($id)
		]);
	}
	public function create()
	{
		$this->view('product/create', ['title' => "Add Product"]);
	}
	public function store()
	{
		$data = [
			"name" => $_POST['name'],
			"price" => $_POST['price'],
			"description" => $_POST['description']
		];

		if ($this->product->insert($data)) {
			$this->redirect("/product");
		} else {
			echo "gagal simpan";
		}	
	}
	public function edit($id)
	{
		$this->view('product/edit', [
			"title" => "Edit Product",
			"product" => $this->product->find($id)
		]);
	}
	public function update($id)
	{
		$data = [
			"name" => $_POST['name'],
			"price" => $_POST['price'],
			"description" => $_POST['description']
		];

		if ($this->product->where("id", $id)->update($data)) {
			$this->redirect("/product");
		} else {
			echo "gagal update";
		}
	}
	public function delete($id)
	{
		if ($this->product->where("id", $id)->delete()) {
			$this->redirect("/product");
		} else {
			echo "gagal hapus";
		}
	}
}
