<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerid'];
}

$customer = new Customer();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin khách hàng</h2>

        <div class="block copyblock">

            <?php
            $get_customer = $customer->show_customers($id);

            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {


            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>Tên</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="name" readonly="readonly" Value="<?php echo $result['name'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="address" readonly="readonly" Value="<?php echo $result['address'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="zipcode" readonly="readonly" Value="<?php echo $result['zipcode'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="phone" readonly="readonly" Value="<?php echo $result['phone'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="email" readonly="readonly" Value="<?php echo $result['email'] ?>" class="medium" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>