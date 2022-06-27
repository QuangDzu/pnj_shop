<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLatestDior = $product->getLatestDior();
			if ($getLatestDior) {
				while ($result = $getLatestDior->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<!-- <input type="hidden" name="productId"> -->
							<a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Dior</h2>
							<p><?php echo $result['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLatestHermes = $product->getLatestHermes();
			if ($getLatestHermes) {
				while ($result = $getLatestHermes->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Hermes</h2>
							<p><?php echo $result['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="section group">
		<?php
			$getLatestChanel = $product->getLatestChanel();
			if ($getLatestChanel) {
				while ($result = $getLatestChanel->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Chanel</h2>
							<p><?php echo $result['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLatestChopard = $product->getLatestChopard();
			if ($getLatestChopard) {
				while ($result = $getLatestChopard->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Chopard</h2>
							<p><?php echo $result['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php
					$get_slider = $product->show_slider();
					if ($get_slider) {
						while ($result_slider = $get_slider->fetch_assoc()) {

					?>
							<li><img src="admin/uploads/<?php echo $result_slider['sliderImage'] ?>" alt="<?php echo $result_slider['sliderName'] ?>" /></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>