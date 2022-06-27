<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>

<?php
$pd = new Product();
$fm = new Format();

if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delpro = $pd->del_product($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm</h2>
		<div class="block">

			<?php
			if (isset($delpro)) {
				echo $delpro;
			}
			?>

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<!-- <th></th> -->
						<th>ID</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Product Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pdlist = $pd->show_product();

					if ($pdlist) {
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['img'] ?>" width="50" alt=""></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td><?php echo $fm->textShorten($result['product_desc'], 20) ?></td>
								<td>
									<?php if ($result['kieu'] == 0) {
										echo 'Không nổi bật';
									} else {
										echo 'Nổi bật';
									}
									?></td>
								<td><a class="btn btn-green" href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> ||
									<a class="btn btn-grey" onclick="return confirm('Bạn chắc chắn muốn xóa dữ liệu này?')" href="?productid=<?php echo $result['productId'] ?>">Xóa</a>
								</td>
							</tr>
					<?php
						}
					}
					?>

				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>