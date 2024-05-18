<div class="container mt-3">
	<h4>Detail Product</h4>
	<div class="row">
		<div class="col-md-6">
			<a href="<?= BASEURL; ?>/product" class="btn btn-outline-secondary btn-sm mt-4">Back</a>
			<a href="<?= BASEURL; ?>/product/<?= $product['id'] ?>/edit" class="btn btn-outline-warning btn-sm mt-4">Edit</a>
			<a href="<?= BASEURL; ?>/product/<?= $product['id'] ?>/delete" class="btn btn-outline-danger btn-sm btn-delete mt-4">Delete</a>
			<div class="card mt-3">
			  <div class="card-body">
			    <h4 class="card-title"><?=$product['name'];?></h4>
			    <p class="card-subtitle mb-2 text-muted">Rp.<?= number_format($product['price']); ?></p>
			    <?= htmlspecialchars_decode($product['description']); ?>
			  </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	const btnDelete = document.querySelector('.btn-delete');
	btnDelete.onclick = () => confirm('Are you sure ?');
</script>