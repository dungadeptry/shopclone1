<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Danh sách thành viên';
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
if ($_GET['id']) {
    $member = (new Controller)->get_row("SELECT * FROM `dga_users` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
    if (!$member) {
        header("Location: /dgaAdmin/member");
    }
} else {
    header("Location: /dgaAdmin/member");
}
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                        <div class="card-header pt-7" id="kt_chat_contacts_header">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2 svg-icon-danger svg-icon-3x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                    </svg>
                                </span>
                                <h2 id="typed"></h2>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <form id="formEditMem" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Username</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="type" value="edit" hidden>
                                    <input type="text" class="form-control form-control-solid" name="username" value="<?= $member['username']; ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Số dư</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="money" value="<?= $member['money']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Đã nạp</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="total_money" value="<?= $member['total_money']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Đã tiêu</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="used_money" value="<?= $member['used_money']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Cấp bậc</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="level" value="<?= $member['rank']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Ngày tạo</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled value="<?= $member['created_at']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">

                                    <?php if ($member['status'] == 0) { ?>
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span class="required">Trạng thái</span>
                                            </label>
                                            <select class="form-select form-select-solid" name="status" data-placeholder="Chọn thư mục cho Products">
                                                <option value="0">ON</option>
                                                <option value="1">OFF</option>
                                            </select>
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span class="required">Trạng thái</span>
                                            </label>
                                            <select class="form-select form-select-solid" name="status" data-placeholder="Chọn thư mục cho Products">
                                                <option value="0">ON</option>
                                                <option value="1">OFF</option>
                                            </select>
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    <?php } ?>

                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Địa chỉ IP</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled value="<?= $member['ip']; ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Trình duyệt</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" disabled value="<?= (new Func)->browser_name($member['UserAgent']); ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">UserAgent</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" disabled value="<?= $member['UserAgent']; ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>



                                <div class="separator mb-6"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.home') }}" class="btn btn-light me-3">Hủy bỏ</a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Sửa</span>
                                    </button>
                                </div>
                                <div></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dga-table" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>TIỀN TRƯỚC</th>
                                        <th>TIỀN THAY ĐỔI</th>
                                        <th>TIỀN HIỆN TẠI</th>
                                        <th>NỘI DUNG</th>
                                        <th>THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_history` WHERE `username` = '" . $member['username'] . "' ") as $row) { ?>
                                        <tr>
                                            <td><?= $row['Mbefore']; ?></td>
                                            <td><?= $row['Mchange']; ?></td>
                                            <td><?= $row['Mafter']; ?></td>
                                            <td><?= $row['content']; ?></td>
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
    });

    $('#formEditMem').on('submit', function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        let contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/editMember",
            method: "POST",
            dataType: "JSON",
            data: contents,
            success: function(data) {
                if (data.status === "error") {
                    toastr.error(data.message, "Thông báo");
                } else {
                    toastr.success(data.message, "Thông báo");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
        return false;
    });
</script>
<?php require_once "./layouts/meta.php"; ?>