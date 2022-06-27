<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false) {
        header('Location: login.php');
    }

    $cart = new Cart();
	if(isset($_GET['comfirmid'])) {
		$id = $_GET['comfirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted_comfirm = $cart->shifted_comfirm($id, $time, $price);
	}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Thông tin đơn hàng</h2>

                <table class="tblone">
                    <tr>
                        <th width="20%">ID</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Hình</th>
                        <th width="15%">Giá</th>
                        <th width="15%">Số lượng</th>
                        <th width="10%">Ngày </th>
                        <th width="10%">Trạng thái</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_cart_ordered = $cart->get_cart_ordered($customer_id);

                    if ($get_cart_ordered) {
                        $i = 0;
                        $quantity = 0;
                        while ($result = $get_cart_ordered->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></td>
                                <td><?php echo $fm->format_currency($result['price']) . ' VNĐ' ?></td>
                                <td>
                                    <?php echo $result['quantity'] ?>
                                </td>
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo 'Pending';
                                    } else if($result['status'] == 1) {
                                        ?>
                                        <span>Shifted</span>
										<!-- <a href="?comfirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Shifting...</a> -->
                                        <?php
                                        } else {
                                        echo 'Receivevd';
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($result['status'] == 0) {
                                ?>
                                    <td><?php echo 'N/A' ?></td>
                                <?php
                                } else if ($result['status'] == 1) {
                                    ?>
                                    <td><a href="?comfirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Comfirm</a></td>
                                    <?php
                                } else if ($result['status'] == 2) {
                                ?>
                                    <td><?php echo 'Receivevd'; ?></td>
                                <?php
                                }
                                ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>