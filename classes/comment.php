<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Comment
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insert_comment($data,$commentName)
    {

        // Kết nối CSDL
        $comment = mysqli_real_escape_string($this->db->link, $data['comment']);

        $query = "INSERT INTO tbl_comment(comment) VALUES('$comment')";
        $result = $this->db->insert($query);
        return $result;
    }

    public function show_comment()
    {
        $query = "SELECT * FROM tbl_comment ORDER BY commentId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_comment($id)
    {
        $query = "DELETE FROM tbl_comment WHERE commentId = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='message success'>Xóa bình luận thành công.</span>";
            return $alert;
        } else {
            $alert = "<span class='message error'>Xóa bình luận thất bại.</span>";
            return $alert;
        }
    }
}
