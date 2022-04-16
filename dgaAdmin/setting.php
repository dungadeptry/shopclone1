<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Cài đặt website';
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
                <div class="col-lg-12">
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
                            <form id="editSetting" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                    <div class="col">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span>Logo </span>
                                            </label>
                                            <div class="mt-1">
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= (new Settings)->info('logo'); ?>')">
                                                    <div class="image-input-wrapper w-200px h-100px" style="background-image: url('<?= (new Settings)->info('logo'); ?>')"></div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg">
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
                                    </div>

                                    <div class="col">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span>Favicon </span>
                                            </label>
                                            <div class="mt-1">
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= (new Settings)->info('favicon'); ?>')">
                                                    <div class="image-input-wrapper w-100px h-100px" style="background-image: url('<?= (new Settings)->info('favicon'); ?>')"></div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="favicon" accept=".png, .jpg, .jpeg">
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
                                    </div>

                                    <div class="col">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span>Background </span>
                                            </label>
                                            <div class="mt-1">
                                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= (new Settings)->info('background'); ?>')">
                                                    <div class="image-input-wrapper w-200px h-100px" style="background-image: url('<?= (new Settings)->info('background'); ?>')"></div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="background" accept=".png, .jpg, .jpeg">
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
                                    </div>

                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Tên web</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="name" value="<?= (new Settings)->info('name'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Tiêu đề website</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="title_web" value="<?= (new Settings)->info('title_web'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Từ khóa website</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="key_word" value="<?= (new Settings)->info('key_word'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Mô tả website</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="description" value="<?= (new Settings)->info('description'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Link hỗ trợ FANPAGE</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="spFb" value="<?= (new Settings)->info('spFb'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Link hỗ trợ TELEGRAM</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="spTele" value="<?= (new Settings)->info('spTele'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Link hỗ trợ ZALO</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="spZalo" value="<?= (new Settings)->info('spZalo'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Chiết khấu bank</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="discountBank" value="<?= (new Settings)->info('discountBank'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Nạp tối thiểu</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="min_recharge" value="<?= (new Settings)->info('min_recharge'); ?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Javascript - Foot - Hiệu ứng</span>
                                    </label>
                                    <textarea rows="12" type="text" class="form-control form-control-solid" name="foot_js" value=""><?= (new Settings)->info('foot_js'); ?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Thông báo website</span>
                                    </label>
                                    <textarea id="dga_textarena" rows="12" type="text" class="form-control form-control-solid" name="notification" value=""><?= (new Settings)->info('notification'); ?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Bảo hành</span>
                                    </label>
                                    <textarea id="dga_insurance" rows="12" type="text" class="form-control form-control-solid" name="insurance" value=""><?= (new Settings)->info('insurance'); ?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Từ chối bảo hành</span>
                                    </label>
                                    <textarea id="dga_no_insurance" rows="12" type="text" class="form-control form-control-solid" name="no_insurance" value=""><?= (new Settings)->info('no_insurance'); ?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Lưu ý nạp tiền</span>
                                    </label>
                                    <textarea id="dga_noteRecharge" rows="12" type="text" class="form-control form-control-solid" name="noteRecharge" value=""><?= (new Settings)->info('noteRecharge'); ?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="separator mb-6"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="/dgaAdmin/home" class="btn btn-light me-3">Hủy</a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Sửa</span>
                                    </button>
                                </div>
                                <div></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('#editSetting').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "/dgaAdmin/models/editSetting",
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
    var textarea = document.getElementById('dga_textarena');
    sceditor.create(textarea, {
        format: 'xhtml',
        style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
    });

    var textarea = document.getElementById('dga_insurance');
    sceditor.create(textarea, {
        format: 'xhtml',
        style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
    });
    var textarea = document.getElementById('dga_no_insurance');
    sceditor.create(textarea, {
        format: 'xhtml',
        style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
    });
    var textarea = document.getElementById('dga_noteRecharge');
    sceditor.create(textarea, {
        format: 'xhtml',
        style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
    });
</script>

<?php require_once "./layouts/meta.php"; ?>