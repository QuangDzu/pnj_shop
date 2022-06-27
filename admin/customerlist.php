<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php'; ?>
<?php
$customer = new Customer();

if (isset($_GET['delid'])) {

	$id = $_GET['delid'];
	$delcustomer = $cat->del_customer($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách khách hàng</h2>
		<div class="block">
			<?php
			if (isset($delcustomer)) {
				echo $delcustomer;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên</th>
						<th>Địa chỉ</th>
						<th>Thành phố</th>
						<th>Sđt</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_customer = $customer->show_customers_all();
					if ($show_customer) {
						$i = 0;
						while ($result = $show_customer->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $result['address'] ?></td>
								<td><?php echo $result['city'] ?></td>
								<td><?php echo $result['phone'] ?></td>
								<td><?php echo $result['email'] ?></td>
								<td><a onclick="return confirm('Bạn chắc chắn muốn xóa dữ liệu này?')" href="?delid=<?php echo $result['id'] ?>">Delete</a></td>
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