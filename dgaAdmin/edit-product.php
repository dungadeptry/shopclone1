<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Danh sách sản phẩm';
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
if ($_GET['id']) {
    $product = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
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
                                <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_product` ORDER BY `arrange` ASC") as $row) { ?>
                                    <div class="d-flex flex-stack py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-4">
                                                <a href="/dgaAdmin/edit-product?id=<?= $row['id']; ?>" class="fs-6 fw-bolder text-<?=(new Func)->active('/dgaAdmin/edit-product?id='.$row['id'].'', 'danger', 'dark');?> text-hover-primary mb-2 "><?= $row['name']; ?> </a>
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
                                <h2>Sửa Sản Phẩm </h2>
                            </div>
                        </div>
                        <?php if ($product) { ?>
                            <div class="card-body pt-5">
                                <form id="editProduct" class="form">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Thư mục</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha" aria-label="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha"></i>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" name="category">
                                        <option value="<?=$product['category'];?>"> <?=(new Controller)->get_row("SELECT * FROM `dga_category` WHERE `token` = '".$product['category']."'")['name'];?> (*)</option>
                                        <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NOT NULL ORDER BY `arrange` ASC") as $row) { ?>
                                            <option value="<?= $row['token']; ?>"><?= $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Tên</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="name" value="<?=$product['name'];?>">
                                    <input type="text" class="form-control form-control-solid" name="id" value="<?=$product['id'];?>" hidden>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Giá</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" name="price" value="<?=$product['price'];?>">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">MÔ TẢ</span>
                                    </label>
                                    <textarea rows="2" type="text" class="form-control form-control-solid" name="details"><?=$product['details'];?></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">THỂ LOẠI</span>
                                    </label>
                                    <select class="form-select form-select-solid" name="type">
                                        <option value="<?=$product['type'];?>"><?=$product['type'];?></option>
                                        <option value="CLONE">CLONE</option>
                                        <option value="BM">BM</option>
                                        <option value="HOTMAIL">HOTMAIL</option>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                    <div class="col">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span class="required">Mua tối thiểu</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid" name="min" value="<?=$product['min'];?>">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fv-row mb-7">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span>Mua tối đa</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid" name="max" value="<?=$product['max'];?>">
                                        </div>
                                    </div>
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

    $('#editProduct').on('submit', function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        let contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/editProduct",
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