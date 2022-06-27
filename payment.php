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
<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
    }

    .wrapper_method {
        text-align: center;
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        background-color: cornsilk;
        padding: 20px;
    }

    .wrapper_method a {
        padding: 10px;
        background: red;
        color: #fff;
    }

</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content-top">
                <div class="heading">
                    <h3>Thanh toán</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Chọn phương thức để thanh toán</h3>
                    <a href="offlinepayment.php">Thanh toán trực tiếp.</a>
                    <a href="onlinepayment.php">Thanh toán trực tuyến.</a> <br><br><br>
                    <a style="background:grey" href="cart.php">
                        << Previous</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "inc/footer.php";
    ?>