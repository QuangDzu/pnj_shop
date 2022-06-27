<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
if (isset($_GET['proid'])) {
    $customer_id = Session::get('customer_id');
	$productId = $_GET['proid'];
	$delfavoriteslist = $product->del_favorites_list($productId, $customer_id);
}

// if (isset($_GET['cartId'])) {
// 	$cartId = $_GET['cartId'];
// 	$delcart = $cart->del_product_cart($cartId);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	$cartId = $_POST['cartId'];
// 	$quantity = $_POST['quantity'];
// 	$update_quantity_cart = $cart->update_quantity_cart($quantity, $cartId);
// 	if ($quantity <= 0) {
// 		$delcart = $cart->del_product_cart($cartId);
// 	}
// }
?>
<?php
	// if(!isset($_GET['id'])) {
	// 	echo "<meta http-equiv='refresh' content='0; URL=?id=live'>";
	// }
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>So sánh sản phẩm</h2>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="20%">Tên sản phẩm</th>
						<th width="20%">Hình</th>
						<th width="15%">Giá</th>
						<th width="25%">Action</th>
					</tr>
					<?php
					$customer_id = Session::get('customer_id');
					$get_favoriteslist = $product->get_favoriteslist($customer_id);

					if ($get_favoriteslist) {
						$i = 0;
						while ($result = $get_favoriteslist->fetch_assoc()) {
							$i++
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></td>
								<td><?php echo $fm->format_currency($result['price']).' '.'VNĐ' ?></td>
								<td><a  href="details.php?proid=<?php echo $result['productId'] ?>">Chi tiết</a></td>
							</tr>
					<?php
						}
					}
					?>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include_once "inc/footer.php";
?>