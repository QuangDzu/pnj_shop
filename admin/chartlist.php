<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
$product = new Product();

// if (isset($_GET['delid'])) {
//     $id = $_GET['delid'];
//     $delbrand = $brand->del_brand($id);
// }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách thương hiệu</h2>
        <div class="block">
            <?php
            // if (isset($delbrand)) {
            //     echo $delbrand;
            // }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Brand Name</th>
                        <th>Brand Name</th>
                        <th>Brand Name</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_thongke = $product->thongke();
                    if ($show_thongke) {
                        $i = 0;
                        while ($result = $show_thongke->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['catName'] ?></td>
                                <td><?php echo $result['soluong'] ?></td>
                                <td><?php echo $result['gia_min'] ?></td>
                                <td><?php echo $result['gia_max'] ?></td>
                                <td><?php echo $result['gia_avg'] ?></td>
                                <td><a class="btn btn-green" href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> ||
                                 <a class="btn btn-grey" onclick="return confirm('Bạn chắc chắn muốn xóa dữ liệu này?')" href="?delid=<?php echo $result['brandId'] ?>">Delete</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>