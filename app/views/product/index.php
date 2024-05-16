<?php 
use App\Core\Message;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
</head>
<body>
	<h1>Data Products</h1>
	<?php 
	if (Message::has('success')) { ?>
		<p><?php Message::flash('success'); ?></p>
	<?php } ?>
	<a href="<?= BASEURL; ?>/product/create">Add Product</a>
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Price</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($products as $key => $product) { ?>
			<tr>
				<td><?=$no++;?></td>
				<td><?=$product['name'];?></td>
				<td><?=$product['price'];?></td>
				<td><?=$product['description'];?></td>
				<td>
					<a href="<?= BASEURL;?>/product/<?= $product['id'];?>">Detail</a>
					<a href="<?= BASEURL;?>/product/<?= $product['id'];?>/edit">Edit</a>
					<a href="<?= BASEURL;?>/product/<?= $product['id'];?>/delete" class="btn-delete">Delete</a>
				</td>
			</tr>
			<?php }
			?>
		</tbody>
	</table>

	<script type="text/javascript">
		const btnDeletes = document.querySelectorAll('.btn-delete');
		btnDeletes.forEach(function(btnDelete) {
			btnDelete.onclick = () => confirm('Are you sure ?');
		});
	</script>
</body>
</html>