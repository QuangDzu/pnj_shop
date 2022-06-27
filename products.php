<?php
include_once "inc/header.php";
include_once "inc/slider.php";
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_new = $product->get_product();

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
		<div class="paging">
			<?php
				$product_new_all = $product->get_product_new_all();
				$product_count = mysqli_num_rows($product_new_all);
				$product_button = ceil($product_count / 4);
				$i = 1;
				for($i = 1; $i < $product_button; $i++) {
					echo '<a class="paging-link" href="?trang='.$i.'">'.$i.'</a> ';
				}
			?>
		</div>
		<!-- <div class="content_bottom">
			<div class="heading">
				<h3>Latest from Acer</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.html"><img src="images/new-pic1.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$403.66</span></p>

				<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-4.html"><img src="images/new-pic2.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$621.75</span></p>
				<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-2.html"><img src="images/feature-pic2.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$428.02</span></p>
				<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<img src="images/new-pic3.jpg" alt="" />
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$457.88</span></p>
				<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
		</div> -->
	</div>
</div>

<?php
include_once "inc/footer.php";
?>