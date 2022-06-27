<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
$login_check = Session::get('customer_login');
if($login_check) { 
	header('Location: order.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$insertCustomers = $customer->insert_customer($_POST);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

	$loginCustomers = $customer->login_customer($_POST);
}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Đăng nhập</h3>
			<p>Đăng nhập bằng biểu mẫu bên dưới.</p>
			<?php
				if(isset($loginCustomers)) {
					echo $loginCustomers;
				}
			?>
			<form action="" method="POST" id="member">
				<input type="text" name="email" value="Email" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
				<input type="password" name="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
			<div class="buttons">
				<div><input type="submit" name="login" value="Sign In" class="login_input"
					 style="padding: 10px 15px; font-size: 15px; font-weight: bold; color: #fff; background-color: #3b3c3c; border-radius: 4px;"></div>
			</div>
			</form>

		</div>
		<?php

		?>
		<div class="register_account" style="height: 320px;">
			<h3>Đăng ký thành viên</h3>
			<?php
				if(isset($insertCustomers)) {
					echo $insertCustomers;
				}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Nhập tên của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
								</div>

								<div>
									<input type="text" name="city" placeholder="Nhập thành phố của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'City';}">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Nhập zip code của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Zip-Code';}">
								</div>
								<div>
									<input type="text" name="email" placeholder="Nhập email của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Nhập địa chỉ của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Address';}">
								</div>
								<div>
									<select style="width: 340px" id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">--------------------------Chọn đất nước--------------------------</option>
										<option value="AF">Afghanistan</option>
										<option value="AF">Afghanistan</option>
										<option value="AF">Afghanistan</option>
										<option value="AF">Afghanistan</option>
										<option value="AF">Afghanistan</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Nhập số điện thoại của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}">
								</div>

								<div>
									<input type="text" name="password" placeholder="Nhập mật khẩu của bạn..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" value="Create Account" class="login_input"
					 style="padding: 10px 15px; font-size: 15px; font-weight: bold; color: #fff; background-color: #3b3c3c; border-radius: 4px;"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include_once "inc/footer.php";
?>