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
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box_right {
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }

    .submit_order {
        padding: 10px 70px;
        border: none;
        background: red;
        font-size: 25px;
        color: 25px;
        color: #fff;
        border-radius: 4px;
        margin: 10px;
    }
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Thanh toán trực tiếp</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <h4>Your Cart</h4>
                        <?php
                        if (isset($update_quantity_cart)) {
                            echo $update_quantity_cart;
                        }
                        ?>
                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Product Name</th>
                                <th width="10%">Image</th>
                                <th width="15%">Price</th>
                                <th width="25%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
                            $get_product_cart = $cart->get_product_cart();

                            if ($get_product_cart) {
                                $subtotal = 0;
                                $quantity = 0;
                                $i = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $result['productName'] ?></td>
                                        <td><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></td>
                                        <td><?php echo $fm->format_currency($result['price']) . ' ' . ' VND' ?></td>
                                        <td>
                                            <?php echo $result['quantity'] ?>
                                        </td>
                                        <td><?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total) . ' ' . ' VND';
                                            ?></td>
                                    </tr>
                            <?php
                                    $subtotal += $total;
                                    $quantity = $quantity + $result['quantity'];
                                }
                            }
                            ?>
                        </table>
                        <?php
                        $check_cart = $cart->check_cart();

                        if ($check_cart) {

                        ?>
                            <table style="float:right;text-align:left;" width="40%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td>
                                        <?php
                                        echo $fm->format_currency($subtotal). ' ' . ' VND';
                                        Session::set('sum', $subtotal);
                                        Session::set('quantity', $quantity);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>VAT : </th>
                                    <td>10% (<?php echo $fm->format_currency($vat = $subtotal * 0.1) . ' ' . ' VND'; ?>)</td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td><?php
                                        $vat = $subtotal * 0.1;
                                        $grandtotal = $subtotal + $vat;
                                        echo $fm->format_currency($grandtotal) . ' ' . ' VND';
                                        ?></td>
                                </tr>
                            </table>
                        <?php
                        } else {
                            echo 'Giỏ hàng của bạn trống!!!';
                        }
                        ?>
                    </div>
                </div>
                <div class="box_right">
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
                                    <td></td>
                                    <td><?php echo $result['zipcode'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Số điện thoại</td>
                                    <td></td>
                                    <td><?php echo $result['phone'] ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><a href="profileedit.php">Sửa thông tin</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <center>
            <a href="?orderid=order" class="submit_order">Đặt hàng</a>
        </center> <br>
    </div>
</form>
<?php
include_once "inc/footer.php";
?>