<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Danh sách clone';
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
if ($_GET['id']) {
    $product = (new Controller)->get_list("SELECT * FROM `dga_product` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
}
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="row g-7">
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <h2>Danh sách clone live</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea rows="12" id="dga_clonelive" class="form-control mb-3"><?php foreach ((new Controller)->get_list("SELECT * FROM `dga_account` WHERE `code` IS NULL AND `status` = '1' AND `product` = '" . $product['id'] . "' ") as $row) { ?> <?= $row['details']; ?> 
<?php } ?></textarea>
                            <button class="btn btn-light-primary" data-clipboard-action="copy" data-clipboard-target="#dga_clonelive">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <h2>Danh sách clone die</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea rows="12" id="dga_clonedie" class="form-control mb-3"><?php foreach ((new Controller)->get_list("SELECT * FROM `dga_account` WHERE `code` IS NULL AND `status` = '0' AND `product` = '" . $product['id'] . "' ") as $row) { ?> <?= $row['details']; ?> 
<?php } ?></textarea>
                            <button class="btn btn-light-primary" data-clipboard-target="#dga_clonedie">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dga-table" class="table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted text-center">
                                        <th>NGƯỜI MUA</th>
                                        <th>UID</th>
                                        <th>FULL</th>
                                        <th>NGÀY ĐĂNG</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_account` WHERE `product` = '" . $product['token'] . "' AND `code` IS NOT NULL ") as $row) { ?>
                                        <tr>
                                            <td><b><?=(new Controller)->get_row("SELECT * FROM `dga_orders` WHERE `code` = '" . $row['code'] . "' ")['username'];?></b></td>
                                            <td><a onclick="coppy('uid_<?=$row['id'];?>')"><p id="uid_<?=$row['id'];?>"><?=$row['uid']; ?></td>
                                            <td><a onclick="coppy('clone_<?=$row['id'];?>')"><p id="clone_<?=$row['id'];?>"><?=$row['details']; ?></p></td>
                                            <td><?= $row['created_at']; ?></td>
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
        const targetLive = document.getElementById('dga_clonelive');
        const buttonLive = targetLive.nextElementSibling;

        var clipboard = new ClipboardJS(buttonLive, {
            targetLive: targetLive,
            text: function() {
                return targetLive.value;
            }
        });

        clipboard.on('success', function(e) {
            const currentLabelLive = buttonLive.innerHTML;

            if (buttonLive.innerHTML === 'Copied!') {
                return;
            }

            buttonLive.innerHTML = 'Copied!';

            setTimeout(function() {
                buttonLive.innerHTML = currentLabelLive;
            }, 3000)
        });


        const targetDie = document.getElementById('dga_clonedie');
        const buttonDie = targetDie.nextElementSibling;

        var clipboard = new ClipboardJS(buttonDie, {
            targetDie: targetDie,
            text: function() {
                return targetDie.value;
            }
        });

        clipboard.on('success', function(e) {
            const currentLabelDie = buttonDie.innerHTML;

            if (buttonDie.innerHTML === 'Copied!') {
                return;
            }

            buttonDie.innerHTML = 'Copied!';

            setTimeout(function() {
                buttonDie.innerHTML = currentLabelDie;
            }, 3000)
        });

    });
</script>
<?php require_once "./layouts/meta.php"; ?>