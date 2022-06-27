<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proid'];
}

$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$productId = $_POST['productId'];
	$insertCompare = $product->insertCompare($productId, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['favoriteslist'])) {
	$productId = $_POST['productId'];
	$insertFavoritesList = $product->insertFavoritesList($productId, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	// $id = $_POST['id'];
	$Addtocart = $cart->add_to_cart($quantity, $id);
}

if (isset($_POST['comment_submit'])) {
	// $commentName = $_POST['commentName'];
	$commentInsert = $customer->insert_comment();
}

?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $product->get_details($id);

			if ($get_product_details) {
				while ($result_details = $get_product_details->fetch_assoc()) {

			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['img'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<!-- <p><?php echo $result_details['product_desc'] ?></p> -->
							<div class="price">
								<p>Giá: <span><?php echo $fm->format_currency($result_details['price']) ?> VNĐ</span></p>
								<p>Loại: <span><?php echo $result_details['catName'] ?></span></p>
								<p>Thương hiệu:<span><?php echo $result_details['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Mua ngay" />
								</form>
								<?php
								if (isset($Addtocart)) {
									echo '<span style="color: red; font-size: 18px;">Sản phẩm đã được thêm vào giỏ hàng.</span>';
								}
								?>
							</div>
							<div class="add-cart">
								<div class="btn_details">
									<form action="" method="post">
										<input type="hidden" class="buysubmit" name="productId" value="<?php echo $result_details['productId'] ?>" />

										<?php
										$login_check = Session::get('customer_login');
										if ($login_check == true) {
											echo '<input style=" float: left;margin-right: 5px;" type="submit" class="buysubmit" name="compare" value="Sản phẩm yêu thích" />';
										} else {
											echo '';
										}
										?>

									</form>
									<!-- <form action="" method="post">
										<input type="hidden" class="buysubmit" name="productId" value="<?php echo $result_details['productId'] ?>" />

										<?php
										$login_check = Session::get('customer_login');
										if ($login_check == true) {
											echo '<input type="submit" class="buysubmit" name="favoriteslist" value="Sản phẩm yêu thích" />';
										} else {
											echo '';
										}
										?>

									</form> -->
								</div>
								<div class="clear"></div>
								<p>
									<?php
											if (isset($insertCompare)) {
												echo $insertCompare;
											}
											?>
									<!-- <?php
									if (isset($insertFavoritesList)) {
										echo $insertFavoritesList;
									}
									?> -->
								</p>
							</div>
						</div>
						<div class="product-desc">
							<h2>Thông tin sản phẩm</h2>
							<p><?php echo $result_details['product_desc'] ?></p>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>LOẠI</h2>
				<ul>
					<?php
					$getall_category = $cat->show_category_frontend();
					if ($getall_category) {
						while ($result_allcat = $getall_category->fetch_assoc()) {

					?>
							<li><a href="productbycat.php?catId=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
					<?php
						}
					}
					?>
				</ul>

			</div>
		</div>
		<div class="binhluan">
			<div class="row">
				<div class="col-md-8">
					<h5>Ý kiến sản phẩm</h5>
					<?php
					if (isset($commentInsert)) {
						echo $commentInsert;
					}
					?>
					<form action="" method="post">
						<p><input type="hidden" value="<?php echo $id ?>" name="product_id_comment"></p>
						<?php
						$login_check = Session::get('customer_login');
						if ($login_check == true) {
							// echo '<input style=" float: left;margin-right: 5px;" type="submit" class="buysubmit" name="compare" value="So sánh sản phẩm" />';
							// echo '<input type="submit" class="buysubmit" name="compare" value="Sản phẩm yêu thích" />';
							// echo '<p><input type="hidden" class="form-control" name="commentName"></p>';
							// echo '<p><textarea placeholder="Bình luận..." class="form-control" name="comment" id="" cols="30" rows="5" style="resize: none;"></textarea></p>';
							// echo '<p><input type="submit" name="comment_submit" class="btn btn-success" value="Gửi bình luận"></p>';
							echo '<p><input type="text" class="form-control" placeholder="Điền tên" name="commentName"></p>';
							echo '<p><textarea placeholder="Bình luận..." class="form-control" name="comment" id="" cols="30" rows="5" style="resize: none;"></textarea></p>';
							echo '<p><input type="submit" name="comment_submit" class="btn btn-success" value="Gửi bình luận"></p>';
						} else {
							echo '<span >Đăng nhập để đóng góp ý kiến.</span>';
						}
						?>



					</form>
				</div>
			</div>

		</div>
	</div>
</div>

<?php
include_once "inc/footer.php";
?>