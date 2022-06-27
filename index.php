<?php
include_once "inc/header.php";
include_once "inc/slider.php";
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm yêu thích</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_feathered = $product->getproduct_feathered();
			if ($product_feathered) {
				while ($result = $product_feathered->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
						<h2><?php echo $result['productName'] ?> </h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 20) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result['price']) ?> VNĐ</span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="paging">
			<?php
				$product_feathered_all = $product->get_product_feathered_all();
				$product_count = mysqli_num_rows($product_feathered_all);
				$product_button = ceil($product_count / 4);
				$i = 1;
				for($i = 1; $i < $product_button; $i++) {
					echo '<a class="paging-link" href="index.php?trang='.$i.'">'.$i.'</a> ';
				}
			?>
		</div>
		<div class="clear"></div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_new = $product->getproduct_new();

			if ($product_new) {
				while ($result_new = $product_new->fetch_assoc()) {

			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_new['img'] ?>" alt="" /></a>
						<h2><?php echo $result_new['productName'] ?> </h2>
						<p><?php echo $fm->textShorten($result_new['product_desc'], 20) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result_new['price'])?> VNĐ</span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<!-- <div class="paging">
			<?php
				$product_new_all = $product->get_product_new_all();
				$product_count = mysqli_num_rows($product_new_all);
				$product_button = ceil($product_count / 4);
				$i = 1;
				for($i = 1; $i < $product_button; $i++) {
					echo '<a class="paging-link" href="index.php?trang='.$i.'">'.$i.'</a> ';
				}
			?>
		</div> -->
	</div>
</div>

<?php
include_once "inc/footer.php";
?>