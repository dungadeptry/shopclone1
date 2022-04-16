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
    $category = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
}
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="row g-7">
                <div class="col-lg-6 col-xl-3">
                    <div class="card card-flush">
                        <div class="card-header pt-7">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <h2>Sửa danh mục</h2>
                            </div>
                        </div>
                        <div class="card-body pt-5" id="kt_contacts_list_body">
                            <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
                                <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` ORDER BY `arrange` ASC") as $row) { ?>
                                    <?php if ($row['images'] == '' && $row['category'] != null) {
                                        $img = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `token` = '" . $row['category'] . "' ")['images'];
                                    } else if ($row['category'] == null) {
                                        $img = $row['images'];
                                    }
                                    ?>
                                    <div class="d-flex flex-stack py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px symbol-circle">
                                                <img alt="DUNGA" src="<?= (new Settings)->info('domain') . $img; ?>" />
                                            </div>
                                            <div class="ms-4">
                                                <a href="/dgaAdmin/edit-category?id=<?= $row['id']; ?>" class="fs-6 fw-bolder text-<?= (new Func)->active('/dgaAdmin/edit-category?id=' . $row['id'] . '', 'danger', 'dark'); ?> text-hover-primary mb-2 "><?= $row['name']; ?> </a>
                                                <div class="fw-bold fs-7 text-muted"><?= $row['token']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed d-none"></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-7">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <h2>Sửa Danh Mục </h2>
                            </div>
                        </div>
                        <?php if ($category) { ?>
                            <div class="card-body pt-5">
                                <form id="editCategory" class="form">
                                    <div class="mb-7">
                                        <label class="fs-6 fw-bold mb-3">
                                            <span>Update Avatar</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg."></i>
                                        </label>
                                        <div class="mt-1">
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= (new Settings)->info('domain') . $category['images']; ?>')">
                                                <div class="image-input-wrapper w-100px h-100px" style="background-image: url('<?= (new Settings)->info('domain') . $category['images']; ?>')"></div>
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Tên</span>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="name" value="<?= $category['name'] ?>" />
                                        <input type="text" class="form-control form-control-solid" name="id" value="<?= $category['id'] ?>" hidden />
                                        <input type="text" class="form-control form-control-solid" name="type" value="edit" hidden />
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

                                    <div class="separator mb-6"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="/dgaAdmin/home" class="btn btn-light me-3">Hủy</a>
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Chỉnh sửa</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="card-body pt-5">
                                <center>
                                    <h1 class="text-danger mt-10">Vui lòng chọn danh mục cần sửa</h1>
                                </center>
                            </div>
                        <?php } ?>
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

    $('#editCategory').on('submit', function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        let contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/editCategory",
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