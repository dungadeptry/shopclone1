<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Danh sách đơn hàng';
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
if (isset($_GET['token'])) {
    $father = (new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` = '" . (new Func)->xss($_GET['token']) . "' ORDER BY `arrange` ASC");
} else {
    $father = null;
}
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dga-table" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>ID</th>
                                        <th>NGƯỜI MUA</th>
                                        <th>MÃ ĐƠN</th>
                                        <th>GIÁ</th>
                                        <th>SẢN PHẨM</th>
                                        <th>SỐ LƯỢNG</th>
                                        <th>NGÀY MUA</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_orders` ORDER BY `id` DESC LIMIT 500") as $row) { ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><span class="badge badge-success"><?= $row['username']; ?></td>
                                            <td><?= $row['code']; ?></td>
                                            <td><?= number_format($row['price']); ?></td>
                                            <td><span class="badge badge-danger"><?= (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `token` = '" . $row['product'] . "'")['name']; ?></td>
                                            <td><?= number_format($row['amount']); ?></td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td>
                                                <a href="/dgaAdmin/view-orders?id=<?= $row['id']; ?>" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-active-light-warning">Xem</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#dga-table").DataTable({
            responsive: true,
            language: {
                search: "Tìm kiếm",
                zeroRecords: "<center>Không tìm thấy kết quả dữ liệu</center>",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                infoEmpty: "Hiển thị 0 đến 0 của 0 mục",
                lengthMenu: "Hiển thị _MENU_ mục",
                infoFiltered: "(Được lọc từ _MAX_ mục)",
                loadingRecords: "Đang lấy dữ liệu...",
                paginate: {
                    previous: "<i class='las la-chevron-left'></i>",
                    next: "<i class='las la-chevron-right'></i>",
                },
                emptyTable: "<center>Không có dữ liệu để hiển thị</center>",
            },
        });
    });
</script>
<?php require_once "./layouts/meta.php"; ?>
