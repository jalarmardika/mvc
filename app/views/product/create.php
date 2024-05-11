<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<h3><?= $title; ?></h3>
	<form action="<?= BASEURL; ?>/product" method="post">
		<div>
			<label>Name</label>
			<input type="text" name="name" required>
		</div>
		<div>
			<label>Price</label>
			<input type="number" name="price" required>
		</div>
		<div>
			<label>Description</label>
			<textarea name="description" required></textarea>
		</div>
		<div>
			<button type="submit" name="submit">Save Product</button>
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