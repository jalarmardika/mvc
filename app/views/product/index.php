<?php 
use App\Core\Message;
?>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<h4>Data Products</h4>
			<?php 
			if (Message::has('success')) { ?>
				<div class="alert alert-success mt-3">
					<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php Message::flash('success'); ?>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-md-6">
					<a href="<?= BASEURL; ?>/product/create" class="btn btn-outline-primary btn-sm my-3">Add Product</a>
				</div>
				<div class="col-md-6">
					<form action="<?= BASEURL ?>/product/search" method="post">
						<div class="input-group my-3">
						  <input type="text" name="keyword" class="form-control" placeholder="Search here..." aria-describedby="button-addon2">
						  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
						</div>
					</form>
				</div>
			</div>
			<table class="table table-bordered table-striped table-hover mb-5">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th class="text-center">Price</th>
						<th>Description</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach ($products as $key => $product) { ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$product['name'];?></td>
						<td class="text-right">Rp.<?= number_format($product['price']); ?></td>
						<td><?= htmlspecialchars_decode($product['description']); ?></td>
						<td>
							<a href="<?= BASEURL;?>/product/<?= $product['id'];?>" class="btn btn-outline-success btn-sm">Detail</a>
							<a href="<?= BASEURL;?>/product/<?= $product['id'];?>/edit" class="btn btn-outline-warning btn-sm">Edit</a>
							<a href="<?= BASEURL;?>/product/<?= $product['id'];?>/delete" class="btn-delete btn btn-outline-danger btn-sm">Delete</a>
						</td>
					</tr>
					<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	const btnDeletes = document.querySelectorAll('.btn-delete');
	btnDeletes.forEach(function(btnDelete) {
		btnDelete.onclick = () => confirm('Are you sure ?');
	});
</script>