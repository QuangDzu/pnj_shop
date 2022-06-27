<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);

            if ($result_check) {
                $alert = "<span class='message error'>Email đã tồn tại.</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(`name`,`address`,`city`,`country`,`zipcode`,`phone`,`email`,`password`) VALUES('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='message success'>Đăng ký thành công.</span>";
                    return $alert;
                } else {
                    $alert = "<span class='message error'>Đăng ký thất bại.</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if (empty($email) || empty($password)) {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE `email`='$email' AND `password`='$password' LIMIT 1";
            $result_check = $this->db->select($check_login);

            if ($result_check != false) {
                $value = $result_check->fetch_assoc();

                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location: order.php');
            } else {
                $alert = "<span class='message error'>Email hoặc password không đúng.</span>";
                return $alert;
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id='$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_customers_all()
    {
        $query = "SELECT * FROM tbl_customer ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_customer($id)
    {
        $query = "DELETE FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='message success'>Xóa danh mục sản phẩm thành công.</span>";
            return $alert;
        } else {
            $alert = "<span class='message error'>Xóa danh mục sản phẩm thất bại.</span>";
            return $alert;
        }
    }

    public function update_customer($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        // $city = mysqli_real_escape_string($this->db->link, $data['city']);
        // $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $address == "" || $zipcode == "" || $phone == "" || $email == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer SET `name`='$name', `address`='$address', `zipcode`='$zipcode', `phone`='$phone', `email`='$email' WHERE id='$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='message success'>Sửa thành công.</span>";
                return $alert;
            } else {
                $alert = "<span class='message error'>Sửa thất bại.</span>";
                return $alert;
            }
        }
    }

    public function insert_comment()
    {
        $product_id = $_POST['product_id_comment'];
        $tennguoibinhluan = $_POST['commentName'];
        $comment = $_POST['comment'];

        if ($tennguoibinhluan == "" || $comment == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_comment(`commentName`,`comment`,`productId`) VALUES('$tennguoibinhluan', '$comment', '$product_id')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='message success'>Bình luận thành công.</span>";
                    return $alert;
                } else {
                    $alert = "<span class='message error'>Bình luận thất bại.</span>";
                    return $alert;
                }
        }
    }
}
?>