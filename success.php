<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $cart->insertOrder($customer_id);
    $delCart = $cart->del_all_data_cart();
    header('Location: success.php');
}

?>

<style>
    .success_order {
        text-align: center;
        color: red;
    }
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Thanh toán thành công.</h2>
                <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $cart->get_amount_price($customer_id);
                if ($get_amount) {
                    $amount = 0;
                    while ($result = $get_amount->fetch_assoc()) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
                ?>
                <p>Tổng giá bạn đã mua từ PNJ là:
                    <?php
                    $vat = $amount * 0.1;
                    $total = $vat + $amount;
                    echo $fm->format_currency($total). ' VND';
                    ?>
                </p>
                <p>Chúng tôi sẽ liên hệ trong thời gian sớm nhất. Vui lòng xem chi tiết đơn hàng của bạn tại đây <a href="orderdetails.php">Click Here</a></p>
            </div>
        </div>
</form>
<?php
include_once "inc/footer.php";
?>