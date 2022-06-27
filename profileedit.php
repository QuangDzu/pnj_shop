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
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateCustomer = $customer->update_customer($_POST, $id);
}

?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content-top">
                <div class="heading">
                    <h3>Sửa thông tin cá nhân</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <?php
                        if (isset($updateCustomer)) {
                            echo '<td colspan="3">' . $updateCustomer . '</td>';
                        }
                        ?>
                    </tr>
                    <?php
                    $id = Session::get('customer_id');
                    $get_customers = $customer->show_customers($id);
                    if ($get_customers) {
                        while ($result = $get_customers->fetch_assoc()) {
                    ?>
                            <tr>
                                <td style="font-weight: bold;">Tên</td>
                                <td>:</td>
                                <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Đia chỉ</td>
                                <td>:</td>
                                <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Zip Code</td>
                                <td>:</td>
                                <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Số điện thoại</td>
                                <td>:</td>
                                <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Email</td>
                                <td>:</td>
                                <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                            </tr>

                            <tr>
                                <td colspan="3"><input type="submit" value="Lưu thông tin" name="submit" class="btn btn-grey"></td>
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