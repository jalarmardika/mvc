<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<h3><?= $title; ?></h3>
	<form action="<?= BASEURL; ?>/product/<?= $product['id']; ?>" method="post">
		<div>
			<label>Name</label>
			<input type="text" name="name" required value="<?= $product['name']; ?>">
		</div>
		<div>
			<label>Price</label>
			<input type="number" name="price" required value="<?= $product['price']; ?>">
		</div>
		<div>
			<label>Description</label>
			<textarea name="description" required><?= $product['description']; ?></textarea>
		</div>
		<div>
			<button type="submit" name="submit">Update Product</button>
			<button type="button" name="back">Back</button>
		</div>
	</form>

	<script type="text/javascript">
		const btnBack = document.querySelector('button[name=back]');
		btnBack.addEventListener('click', function() {
			window.location.href = "<?= BASEURL; ?>/product";
		})
	</script>
</body>
</html>