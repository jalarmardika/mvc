<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
	  <div class="container">
	      <a class="navbar-brand" href="<?= BASEURL; ?>/home">PHP MVC</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	      </button>
	      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	        <div class="navbar-nav">
	          <a class="nav-item nav-link active" href="<?= BASEURL; ?>/home">Home <span class="sr-only">(current)</span></a>
	          <a class="nav-item nav-link active" href="<?= BASEURL; ?>/about">About</a>
	          <a class="nav-item nav-link active" href="<?= BASEURL; ?>/product">Products</a>
	        </div>
	      </div>
	  </div>
	</nav>