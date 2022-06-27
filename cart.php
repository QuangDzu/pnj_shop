<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
if (isset($_GET['cartId'])) {
	$cartId = $_GET['cartId'];
	$delcart = $cart->del_product_cart($cartId);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$update_quantity_cart = $cart->update_quantity_cart($quantity, $cartId);
	if ($quantity <= 0) {
		$delcart = $cart->del_product_cart($cartId);
	}
}
?>
<?php
	if(!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0; URL=?id=live'>";
	}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Giỏ hàng</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				?>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $cart->get_product_cart();

					if ($get_product_cart) {
						$subtotal = 0;
						$quantity = 0;
						while ($result = $get_product_cart->fetch_assoc()) {

					?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></td>
								<td><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($total)." "."VNĐ";
									?></td>
								<td><a onclick="return confirm('Bạn chắc chắn muốn xóa?');" href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
					<?php
							$subtotal += $total;
							$quantity = $quantity + $result['quantity'];
						}
					}
					?>
				</table>
				<?php
				$check_cart = $cart->check_cart();

				if ($check_cart) {

				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td>
								<?php
								echo $fm->format_currency($subtotal)." "."VNĐ";
								Session::set('sum', $subtotal);
								Session::set('quantity', $quantity);
								?>
							</td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td><?php
								$vat = $subtotal * 0.1;
								$grandtotal = $subtotal + $vat;
								echo $fm->format_currency($grandtotal)." "."VNĐ";
								?></td>
						</tr>
					</table>
				<?php
				} else {
					echo 'Giỏ hàng của bạn trống!!!';
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php" class="btn" style="border: 1px solid ; color:#666; background-color:burlywood"> <img src="images/shop.png" alt="" />Shoping</a>
				</div>
				<div class="shopright">
					<a href="payment.php" class="btn" style="border: 1px solid #666; background-color:darkgrey; color:aliceblue;"> <img src="images/check.png" alt="" />Thanh toán</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
</div>

<?php
include_once "inc/footer.php";
?>