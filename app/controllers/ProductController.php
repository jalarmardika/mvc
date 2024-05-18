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
		if (isset($_POST['keyword'])) {
			$keyword = $_POST['keyword'];
			$data = $this->product->where("name", "%".$keyword."%", "like")
								->orWhere("price", "%".$keyword."%", "like")
								->orWhere("description", "%".$keyword."%", "like")
								->orderBy("id", "desc")
								->get();
		} else {
			$data = $this->product->orderBy("id", "desc")->get();
		}

		$this->view('template/header', [
			"title" => "Data Products"
		]);
		$this->view('product/index', [
			"products" => $data
		]);
		$this->view('template/footer');
	}
	public function show($id)
	{
		$product = $this->product->find($id);

		$this->view('template/header', [
			"title" => "Detail Product"
		]);
		$this->view('product/detail', [
			"product" => $product
		]);
		$this->view('template/footer');
	}
	public function create()
	{
		$this->view('template/header', [
			"title" => "Add Product"
		]);
		$this->view('product/create');
		$this->view('template/footer');
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
		$product = $this->product->find($id);

		$this->view('template/header', [
			"title" => "Edit Product"
		]);
		$this->view('product/edit', [
			"product" => $product
		]);
		$this->view('template/footer');
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
