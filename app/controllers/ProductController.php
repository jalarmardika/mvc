<?php 
namespace App\Controllers;

use App\Core\{Controller, Message};
use App\Models\Product;

class ProductController extends Controller {

	private $product;

	public function __construct()
	{
		$this->product = new Product();
	}
	public function index()
	{
		$data = $this->product->orderBy("id", "desc")->get();
		$this->view('product/index', [
			"products" => $data
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

		$this->product->insert($data);

		Message::setFlash('success', 'Data Saved Successfully');
		$this->redirect("/product");
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

		$this->product->where("id", $id)->update($data);

		Message::setFlash('success', 'Data Updated Successfully');
		$this->redirect("/product");
	}
	public function delete($id)
	{
		$this->product->where("id", $id)->delete();

		Message::setFlash('success', 'Data Deleted Successfully');
		$this->redirect("/product");
	}

}
