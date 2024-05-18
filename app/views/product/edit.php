<div class="container mt-3">
	<h3>Edit Product</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="card mt-4">
				<div class="card-body">
					<form action="<?= BASEURL; ?>/product/<?= $product['id']; ?>" method="post">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" required class="form-control" value="<?= $product['name']; ?>" autofocus>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="number" name="price" required class="form-control" value="<?= $product['price']; ?>">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" required class="form-control"><?= $product['description']; ?></textarea>
						</div>
						<div>
							<button type="submit" name="submit" class="btn btn-outline-primary btn-sm float-right">Update Product</button>
							<button type="button" name="back" class="btn btn-outline-danger btn-sm float-right mr-2">Back</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	const btnBack = document.querySelector('button[name=back]');
	btnBack.addEventListener('click', function() {
		window.location.href = "<?= BASEURL; ?>/product";
	})
</script>
