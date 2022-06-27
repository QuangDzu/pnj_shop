<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h3>BIỂU ĐỒ THỐNG KÊ</h3>
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Loại', 'Số Lượng'],
                    <?php
                    foreach ($items as $item) {
                        echo "['$item[ten_loai]', $item[so_luong]],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'TỶ LỆ HÀNG HÓA',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>
        <!-- <h2>Update Copyright Text</h2>
        <div class="block copyblock">
            <form>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" placeholder="Enter Copyright Text..." name="copyright" class="large" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div> -->
    </div>
</div>
<?php include 'inc/footer.php'; ?>