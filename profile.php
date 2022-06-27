<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location: login.php');
}
?>
<?php
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
// 	echo "<script>window.location = '404.php'</script>";
// } else {
// 	$id = $_GET['proid'];
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$Addtocart = $cart->add_to_cart($quantity, $id);
}

?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content-top">
                <div class="heading">
                    <h3>Thông tin cá nhân</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <?php
                    $id = Session::get('customer_id');
                    $get_customers = $customer->show_customers($id);
                    if ($get_customers) {
                        while ($result = $get_customers->fetch_assoc()) {
                    ?>
                            <tr>
                                <td style="font-weight: bold;">Tên</td>
                                <td>:</td>
                                <td><?php echo $result['name'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Địa chỉ</td>
                                <td>:</td>
                                <td><?php echo $result['address'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Thành phố</td>
                                <td>:</td>
                                <td><?php echo $result['city'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Zip Code</td>
                                <td>:</td>
                                <td><?php echo $result['zipcode'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Số điện thoại</td>
                                <td>:</td>
                                <td><?php echo $result['phone'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Email</td>
                                <td>:</td>
                                <td><?php echo $result['email'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><a style="border: 1px solid;" class="btn btn-grey" href="profileedit.php">Sửa thông tin</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>