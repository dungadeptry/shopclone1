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
    $product = (new Controller)->get_list("SELECT * FROM `dga_product` WHERE `category` = '" . (new Func)->xss($_GET['token']) . "' ORDER BY `arrange` ASC");
} else {
    $father = null;
    $product = null;
}
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-lg-6">
                    <div class="card">
                        <form id="arrangeFather">
                            <div class="card-header">
                                <h3 class="card-title">Sắp xếp thứ tự cha</h3>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-sm btn-dark">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 g-10 min-h-200px draggable-father">
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NULL ORDER BY `arrange` ASC") as $row) { ?>
                                        <div class="col draggable">
                                            <div class="card card-bordered">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h3 class="card-label"><?= $row['name']; ?></h3>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                                            <span class="svg-icon svg-icon-2x">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <input type="hidden" name="arrange[]" value="<?= $row['id']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <form id="arrangeChildren">
                            <div class="card-header">
                                <h3 class="card-title">Sắp xếp thứ tự con</h3>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-sm btn-dark">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 g-10 min-h-200px draggable-children">

                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Thư mục</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha" aria-label="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha"></i>
                                        </label>
                                        <select onchange="getFather(this);" class="form-select form-select-solid" data-control="select2" name="category">
                                            <option value="">Chọn thư mục cha</option>
                                            <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NULL ORDER BY `arrange` ASC") as $row) { ?>
                                                <option value="<?= $row['token']; ?>"><?= $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <?php if ($father != null) { ?>
                                        <?php foreach ($father as $row) { ?>
                                            <div class="col draggable">
                                                <div class="card card-bordered">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h3 class="card-label"><a href="/" class="text-dark"><?= $row['name']; ?></a></h3>
                                                        </div>
                                                        <div class="card-toolbar">
                                                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                                                <span class="svg-icon svg-icon-2x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <input type="hidden" name="arrange[]" value="<?= $row['id']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <h1 class="text-center text-danger">Không có dữ liệu</h1>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <form id="arrangeProducts">
                            <div class="card-header">
                                <h3 class="card-title">Sắp xếp thứ sản phẩm</h3>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-sm btn-dark">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 g-10 min-h-200px draggable-children">

                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold form-label mt-3">
                                            <span class="required">Thư mục</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha" aria-label="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha"></i>
                                        </label>
                                        <select onchange="getFather(this);" class="form-select form-select-solid" data-control="select2" name="category">
                                            <option value="">Chọn thư mục</option>
                                            <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_category` WHERE `category` IS NOT NULL ORDER BY `arrange` ASC") as $row) { ?>
                                                <option value="<?= $row['token']; ?>"><?= $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <?php if ($product != null) { ?>
                                        <?php foreach ($product as $row) { ?>
                                            <div class="col draggable">
                                                <div class="card card-bordered">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h3 class="card-label"><a href="/" class="text-dark"><?= $row['name']; ?></a></h3>
                                                        </div>
                                                        <div class="card-toolbar">
                                                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                                                <span class="svg-icon svg-icon-2x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <input type="hidden" name="arrange[]" value="<?= $row['id']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <h1 class="text-center text-danger">Không có dữ liệu</h1>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Private functions
        var containers = document.querySelectorAll('.draggable-father');
        if (containers.length === 0) {
            return false;
        }
        var swappable = new Sortable.default(containers, {
            draggable: '.draggable',
            handle: '.draggable .draggable-handle',
            mirror: {
                //appendTo: selector,
                appendTo: 'body',
                constrainDimensions: true
            }
        });

        var containers = document.querySelectorAll('.draggable-children');
        if (containers.length === 0) {
            return false;
        }
        var swappable = new Sortable.default(containers, {
            draggable: '.draggable',
            handle: '.draggable .draggable-handle',
            mirror: {
                //appendTo: selector,
                appendTo: 'body',
                constrainDimensions: true
            }
        });

    });

    function getFather(sel) {
        if (sel.value != null) {
            location.href = "/dgaAdmin/arrange?token=" + sel.value;
        }
    }

    $('#arrangeFather').on('submit', function() {
        var contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/arrangeFather",
            method: "POST",
            dataType: "JSON",
            data: contents,
            success: function(data) {
                if (data.status === "error") {
                    swal(data.message, "error")
                } else {
                    swal(data.message, "success")
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
        return false;
    });

    $('#arrangeChildren').on('submit', function() {
        var contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/arrangeChildren",
            method: "POST",
            dataType: "JSON",
            data: contents,
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

    $('#arrangeProducts').on('submit', function() {
        var contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/arrangeProducts",
            method: "POST",
            dataType: "JSON",
            data: contents,
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
</script>
<?php require_once "./layouts/meta.php"; ?>