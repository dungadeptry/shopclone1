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
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dga-table" class="table table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-muted">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Ngày xác thực</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_users` ") as $row) { ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="/dgaAdmin/edit-member?id=<?= $row['id']; ?>" class="text-<?= $row['status'] == 1 ? 'danger' : 'success'; ?> fw-bolder text-hover-primary mb-1 fs-6"><?= $row['username']; ?></a>
                                                        <!-- <span class="text-muted fw-bold text-muted d-block fs-6">{{ $user->email }}</span> -->

                                                        <span class="text-muted fw-bold d-block fs-6">Trạng thái: <b class="text-<?= $row['status'] == 1 ? 'danger' : 'success'; ?>"><?= $row['status'] == 1 ? 'OFF' : 'ON'; ?></bspan>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6"><i class="las la-wallet fs-2 text-success"></i> Số dư:
                                                            <b data-kt-countup="true" data-kt-countup-value="<?= number_format($row['money']); ?>"><?= number_format($row['money']); ?></b></span>
                                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6"><i class="las la-hand-holding-usd fs-2 text-danger"></i> Đã
                                                            tiêu:
                                                            <b data-kt-countup="true" data-kt-countup-value="<?= number_format($row['total_money']); ?>"><?= number_format($row['total_money']); ?></b></span>
                                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6"><i class="las la-donate fs-2 text-warning"></i> Đã nạp:
                                                            <b data-kt-countup="true" data-kt-countup-value="<?= number_format($row['used_money']); ?>"><?= number_format($row['used_money']); ?></b></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td><a onclick="remove(<?= $row['id']; ?>)" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">Xóa</a>
                                                <a href="/dgaAdmin/edit-member?id=<?= $row['id']; ?>" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary">Sửa</a>
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






    function remove(id) {
        Swal.fire({
            title: "Chắc chắn chứ?",
            text: "Bạn xác nhận xóa thành viên này ra khỏi hệ thống?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/dgaAdmin/models/editMember",
                    type: "POST",
                    data: {
                        type: 'remove',
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status === "error") {
                            toastr["error"](data.message, "Thông báo")
                        } else {
                            toastr["success"](data.message, "Thông báo")
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            };
        });
    };
</script>
<?php require_once "./layouts/meta.php"; ?>