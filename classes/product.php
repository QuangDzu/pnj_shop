<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insert_product($data, $files)
    {

        // Kết nối CSDL
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $type = mysqli_real_escape_string($this->db->link, $data['kieu']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);

        // Kiểm tra hình ảnh cho vào folder upload
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(',', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $type == "" || $price == "" || $file_name == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,kieu,price,img) VALUES('$productName', '$category', '$brand', '$product_desc', '$type', '$price', '$unique_image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='message success'>Thêm danh mục sản phẩm thành công.</span>";
                return $alert;
            } else {
                $alert = "<span class='message error'>Thêm danh mục sản phẩm thất bại.</span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {
        // Kết nối CSDL
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $type = mysqli_real_escape_string($this->db->link, $data['kieu']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);

        // Kiểm tra hình ảnh cho vào folder upload
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(',', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $type == "" || $price == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // Nếu người dùng chọn ảnh
                if ($file_size > 204800) {
                    $alert = "<span class='message success'>Ảnh nên nhỏ hơn 2MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permitted) === true) {
                    $alert = "<span class='message error'>Bạn chỉ upload được: " . implode(',', $permitted) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET 
                `productName` = '$productName', 
                `catId` = '$category', 
                `brandId` = '$brand', 
                `product_desc` = '$product_desc', 
                `kieu` = '$type', 
                `price` = '$price', 
                `img` = '$unique_image' 
                WHERE `tbl_product`.`productId` = '$id'";

                $result = $this->db->update($query);

                if ($result) {
                    $alert = "<span class='message success'>Sửa sản phẩm thành công.</span>";
                    return $alert;
                } else {
                    $alert = "<span class='message success'>Sửa sản phẩm thành công.</span>";
                    return $alert;
                }
            } else {
                // Nếu người dùng không chọn ảnh.
                $query = "UPDATE tbl_product SET 
                `productName` = '$productName', 
                `catId` = '$category', 
                `brandId` = '$brand', 
                `product_desc` = '$product_desc', 
                `kieu` = '$type', 
                `price` = '$price' 
                WHERE `tbl_product`.`productId` = '$id'";
            }
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='message success'>Sửa sản phẩm thành công.</span>";
                return $alert;
            } else {
                $alert = "<span class='message error'>Sửa sản phẩm thất bại.</span>";
                return $alert;
            }
        }
    }

    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='message success'>Xóa sản phẩm thành công.</span>";
            return $alert;
        } else {
            $alert = "<span class='message error'>Xóa sản phẩm thất bại.</span>";
            return $alert;
        }
    }

    public function del_favorites_list($productId, $customer_id)
    {
        $query = "DELETE FROM tbl_favoriteslist WHERE productId = '$productId' AND customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    // END BACKEND
    // 
    // Product
    public function getproduct_feathered()
    {
        $sp_tung_trang = 4;
        if(!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang =  ($trang - 1) * $sp_tung_trang;
        $query = "SELECT * FROM tbl_product WHERE kieu = '0' ORDER BY productId DESC LIMIT $tung_trang, $sp_tung_trang";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_feathered_all()
    {
        $query = "SELECT * FROM tbl_product WHERE kieu = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new()
    {
        $sp_tung_trang = 4;
        if(!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang =  ($trang - 1) * $sp_tung_trang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang, $sp_tung_trang";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product()
    {
        $sp_tung_trang = 8;
        if(!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang =  ($trang - 1) * $sp_tung_trang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang, $sp_tung_trang";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_new_all()
    {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        WHERE tbl_product.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    // Bengin: Latest Product
    public function getLatestDior()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '12' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLatestHermes()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '10' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLatestChanel()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '11' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLatestChopard()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    // End: Latest Product
    public function get_compare($customer_id)
    {
        $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompare($productId, $customer_id)
    {
        // Kết nối CSDL
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND customer_id = '$customer_id'";
        $result_check_compare = $this->db->select($check_compare);
        if ($result_check_compare) {
            $alert = "<span class='message error'>Sản phẩm đã thêm vào danh sách yêu thích.</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $img = $result['img'];

            $query_insert = "INSERT INTO tbl_compare(`customer_id`,`productId`,`productName`,`price`,`img`) VALUES('$customer_id', '$productId', '$productName', '$price', '$img')";
            $insert_compare = $this->db->insert($query_insert);

            if ($insert_compare) {
                $alert = "<span class='message success'>Thêm sản phẩm yêu thích thành công.</span>";
                return $alert;
            } else {
                $alert = "<span class='message error'>Thêm sản phẩm yêu thích thất bại.</span>";
                return $alert;
            }
        }
    }
    public function del_comape($productId, $customer_id)
    {
        $query = "DELETE FROM tbl_compare WHERE productId = '$productId' AND customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function get_favoriteslist($customer_id)
    {
        $query = "SELECT * FROM tbl_favoriteslist WHERE customer_id = '$customer_id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertFavoritesList($productId, $customer_id)
    {
        // Kết nối CSDL
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_favoriteslist = "SELECT * FROM tbl_favoriteslist WHERE productId = '$productId' AND customer_id = '$customer_id'";
        $result_check_favoriteslist = $this->db->select($check_favoriteslist);
        if ($result_check_favoriteslist) {
            $alert = "<span class='message error'>Sản phẩm đã thêm vào so sánh.</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $img = $result['img'];

            $query_insert = "INSERT INTO tbl_favoriteslist(`customer_id`,`productId`,`productName`,`price`,`img`) VALUES('$customer_id', '$productId', '$productName', '$price', '$img')";
            $insert_favoriteslist = $this->db->insert($query_insert);

            if ($insert_favoriteslist) {
                $alert = "<span class='message success'>Thêm sản phẩm so sánh thành công.</span>";
                return $alert;
            } else {
                $alert = "<span class='message error'>Thêm sản phẩm so sánh thất bại.</span>";
                return $alert;
            }
        }
    }

    public function search_product($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
    // End: Product
    // Slider
    public function insert_silder($data, $files)
    {

        // Kết nối CSDL
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        // Kiểm tra hình ảnh cho vào folder upload
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(',', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($sliderName == "" || $type == "") {
            $alert = "<span class='message error'>Các trường không được trống.</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // Nếu người dùng chọn ảnh
                if ($file_size > 20480000) {
                    $alert = "<span class='message success'>Ảnh nên nhỏ hơn 2MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permitted) === true) {
                    $alert = "<span class='message error'>Bạn chỉ upload được: " . implode(',', $permitted) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(`sliderName`, `sliderImage`, `type`) VALUES('$sliderName', '$unique_image', '$type')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='message success'>Thêm slider thành công.</span>";
                    return $alert;
                } else {
                    $alert = "<span class='message error'>Thêm slider thất bại.</span>";
                    return $alert;
                }
            }
        }
    }

    public function show_slider()
    {
        $query = "SELECT * FROM tbl_slider WHERE `type` = 1 ORDER BY sliderId ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slider_list()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_type_slider($id, $type)
    {
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET `type` = '$type' WHERE `sliderId` = '$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function del_slider($id)
    {
        $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alert = "<span class='message success'>Xóa slider thành công.</span>";
            return $alert;
        } else {
            $alert = "<span class='message error'>Xóa slider thất bại.</span>";
            return $alert;
        }
    }

    public function thongke()
    {

        $query = "SELECT tbl_category.catId, tbl_category.catName,"
                ."COUNT(*) so_luong,"
                ."MIN(tbl_product.price) gia_min,"
                ."MAX(tbl_product.price) gia_max,"
                ."AVG(tbl_product.price) gia_avg"
                ."FROM tbl_product hh"
                ."JOIN tbl_category cat ON cat.catId = hh.catId"
                ."GROUP BY cat.catId, cat.catName";
        $result = $this->db->select($query);
        return $result;
    }
}
