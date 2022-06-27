<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        // Kết nối CSDL
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $productName = $result['productName'];
        $price = $result['price'];
        $img = $result['img'];

        $query_cart = "SELECT * FROM tbl_cart WHERE `productId` = '$id' AND `sId` = '$sId'";
        $check_cart = $this->db->select($query_cart);
        if ($check_cart) {
            $msg = "Sản phẩm đã được thêm vào giỏ hàng";
            return $msg;
        } else {
            $query_insert = "INSERT INTO tbl_cart(`productId`,`sId`,`productName`,`price`,`quantity`,`img`) VALUES('$id', '$sId', '$productName', '$price', '$quantity', '$img')";
            $insert_cart = $this->db->insert($query_insert);

            if ($insert_cart) {
                header('Location: cart.php');
            } else {
                header('Location: 404.php');
            }
        }
    }

    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE `sId` = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        return $result;

        if ($result) {
            header('Location: cart.php');
            $msg = "<span class='message success'>Cập nhật số lượng sản phẩm thành công.</span>";
            return $msg;
        } else {
            $msg = "<span class='message error'>Cập nhật số lượng sản phẩm không thành công.</span>";
            return $msg;
        }
    }

    public function del_product_cart($cartId)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        return $result;

        if ($result) {
            header('Location: cart.php');
        } else {
            $msg = "<span class='message error'>Xóa sản phẩm không thành công.</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE `sId` = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_order($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE `customer_id` = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE `sId` = '$sId'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function del_all_data_compare($customer_id)
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_compare WHERE `customer_id` = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "SELECT *FROM tbl_cart WHERE `sId` = '$sId'";
        $get_product = $this->db->select($query);

        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $img = $result['img'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order(`productId`,`productName`,`quantity`,`price`,`img`,`customer_id`) VALUES('$productId', '$productName', '$quantity', '$price', '$img', '$customer_id')";
                $insert_order = $this->db->insert($query_order);

                if ($insert_order) {
                    header('Location: cart.php');
                } else {
                    header('Location: 404.php');
                }
            }
        }
    }

    public function get_amount_price($customer_id)
    {
        // $sId = session_id();
        $query = "SELECT price FROM tbl_order WHERE `customer_id` = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE `customer_id` = '$customer_id'";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
    }

    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET `status` = '1' WHERE id = '$id' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;

        if ($result) {
            $msg = "<span class='message success'>Cập nhật đơn hàng thành công.</span>";
            return $msg;
        } else {
            $msg = "<span class='message error'>Cập nhật đơn hàng không thành công.</span>";
            return $msg;
        }
    }

    public function del_shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order WHERE id = '$id' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->delete($query);
        return $result;

        if ($result) {
            $msg = "<span class='message success'>Xóa đơn hàng thành công.</span>";
            return $msg;
        } else {
            $msg = "<span class='message error'>Xóa đơn hàng không thành công.</span>";
            return $msg;
        }
    }

    public function shifted_comfirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET `status` = '2' WHERE customer_id = '$id' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;

    }
}
?>