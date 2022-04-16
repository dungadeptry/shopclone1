<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
if ($_GET['id']) {
    $orders = (new Controller)->get_row("SELECT * FROM `dga_orders` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
    if (!$orders) {
        header("Location: /dgaAdmin/orders");
    }
}
$title = 'Danh sách clone đơn #' . $orders['code'];
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="row g-7">
                <div class="col-lg-12">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-10">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Chi tiết</h3>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex flex-wrap justify-content-between pb-6">
                                <div class="d-flex flex-wrap">
                                    <div class="border border-dashed border-gray-300 w-300px rounded my-3 p-4 me-6">
                                        <span class="fs-2x fw-bolder text-gray-800 lh-1">
                                            <span><?= $orders['username']; ?></span>
                                        </span>
                                        <span class="fs-6 fw-bold text-gray-400 d-block lh-1 pt-2">Người mua</span>
                                    </div>
                                    <div class="border border-dashed border-gray-300 w-300px rounded my-3 p-4 me-6">
                                        <span class="fs-2x fw-bolder text-gray-800 lh-1">
                                            <span><?= number_format($orders['price']); ?></span>
                                        </span>
                                        <span class="fs-6 fw-bold text-gray-400 d-block lh-1 pt-2">Giá tiền</span>
                                    </div>
                                    <div class="border border-dashed border-gray-300 w-300px rounded my-3 p-4 me-6">
                                        <span class="fs-2x fw-bolder text-gray-800 lh-1">
                                            <span><?= number_format($orders['amount']); ?></span>
                                        </span>
                                        <span class="fs-6 fw-bold text-gray-400 d-block lh-1 pt-2">Số lượng</span>
                                    </div>
                                    <div class="border border-dashed border-gray-300 w-300px rounded my-3 p-4 me-6">
                                        <span class="fs-2x fw-bolder text-gray-800 lh-1">
                                            <span><?= $orders['created_at']; ?></span>
                                        </span>
                                        <span class="fs-6 fw-bold text-gray-400 d-block lh-1 pt-2">Ngày mua</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <h2>Danh sách clone mua của đơn #<?= $orders['code']; ?></h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea rows="12" id="dga_clone" class="form-control mb-3"><?php foreach ((new Controller)->get_list("SELECT * FROM `dga_account` WHERE `code` = '" . $orders['code'] . "' ") as $row) { ?> <?= $row['details']; ?> 
<?php } ?></textarea>
                            <button class="btn btn-light-primary" data-clipboard-action="copy" data-clipboard-target="#dga_clone">
                                Copy
                            </button>
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
        const target = document.getElementById('dga_clone');
        const button = target.nextElementSibling;

        var clipboard = new ClipboardJS(button, {
            target: target,
            text: function() {
                return target.value;
            }
        });

        clipboard.on('success', function(e) {
            const currentLabel = button.innerHTML;

            if (button.innerHTML === 'Copied!') {
                return;
            }

            button.innerHTML = 'Copied!';

            setTimeout(function() {
                button.innerHTML = currentLabel;
            }, 3000)
        });

    });
</script>
<?php require_once "./layouts/meta.php"; ?>