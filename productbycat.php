<?php
include_once "inc/header.php";
?>
<?php
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['catId'];
}

// $cat = new Category();
// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $catName = $_POST['catName'];

//     $updateCat = $cat->update_category($catName, $id);
// }
?>

<div class="main">
	<div class="content">
		<?php
		$name_cat = $cat->get_name_by_cat($id);
		if ($name_cat) {
			while ($result_name = $name_cat->fetch_assoc()) {

		?>
				<div class="content_top">

					<div class="heading">
						<h3>Danh mục: <?php echo $result_name['catName'] ?></h3>
					</div>

					<div class="clear"></div>
				</div>
		<?php
			}
		}
		?>
		<div class="section group">
			<?php
			$get_product_by_cat = $cat->get_product_by_cat($id);
			if ($get_product_by_cat) {
				while ($result = $get_product_by_cat->fetch_assoc()) {

			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.html"><img src="admin/uploads/<?php echo $result['img'] ?>" width="200px" alt="" /></a>
						<h2><?php echo $result['productName'] ?></h2>
						<p><?php echo $fm->textShorten($result['product_desc']) ?></p>
						<p><span class="price"><?php echo $result['price'] ?> VNĐ</span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
					</div>
			<?php
				}
			} else {
				echo 'Danh mục không có sản phẩm.';
			}
			?>
		</div>
	</div>
</div>

<?php
include_once "inc/footer.php";
?>