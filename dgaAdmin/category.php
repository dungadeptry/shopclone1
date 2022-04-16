<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Sắp xếp thứ tự';
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
                <div class="col-lg-7">
                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                        <div class="card-header pt-7" id="kt_chat_contacts_header">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <h2>Thêm danh mục</h2>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <form id="addCategory" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                <div class="mb-7">
                                    <label class="fs-6 fw-bold mb-3">
                                        <span>Update Thumb</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allowed file types: png, jpg, jpeg." aria-label="Allowed file types: png, jpg, jpeg."></i>
                                    </label>
                                    <div class="mt-1">
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= (new Settings)->info('domain'); ?>/dgaAdmin/assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-100px h-100px" style="background-image: url('<?= (new Settings)->info('domain'); ?>/dgaAdmin/assets/media/svg/avatars/blank.svg')"></div>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="thumb" accept=".png, .jpg, .jpeg">
                                                <input type="hidden">
                                            </label>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Loại</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha" aria-label="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha"></i>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" name="category">
                                        <option value="0">Thư mục cha</option>
                                        <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NULL ORDER BY `arrange` ASC") as $row) { ?>
                                            <option value="<?= $row['token']; ?>"><?= $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Tên</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="name" value="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="separator mb-6"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="/dgaAdmin/edit-category" class="btn btn-info w-100 me-3">Sửa danh mục</a>
                                    <a href="/dgaAdmin/home" class="btn btn-danger me-3">Hủy</a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Thêm</span>
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
                                        <th>THƯ MỤC</th>
                                        <th>THƯ MỤC CHA</th>
                                        <th>NGÀY TẠO</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` ORDER BY `arrange` ASC") as $row) { ?>
                                        <tr>
                                            <td><?= $row['name']; ?></td>
                                            <?php if ($row['category'] != null || $row['category'] != '') { ?>
                                                <td><?= (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `token` = '" . $row['category'] . "' ")['name']; ?></td>
                                            <?php } else { ?>
                                                <td>Không có</td>
                                            <?php } ?>
                                            <td><?= $row['created_at']; ?></td>
                                            <td><a onclick="remove(<?= $row['id']; ?>)" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">Xóa</a>
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
    $('#addCategory').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "/dgaAdmin/models/addCategory",
            method: "POST",
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
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
        return false;
    });

    function remove(id) {
        Swal.fire({
            title: "Chắc chắn chứ?",
            text: "Bạn xác nhận xóa danh mục này ra khỏi hệ thống?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/dgaAdmin/models/editCategory",
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