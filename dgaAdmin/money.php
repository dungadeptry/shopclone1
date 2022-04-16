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
            <div class="row gy-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                        <div class="card-header pt-7" id="kt_chat_contacts_header">
                            <div class="card-title">
                                <span class="svg-icon svg-icon-1 me-2 svg-icon-danger svg-icon-3x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="black" />
                                        <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="black" />
                                        <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="black" />
                                        <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="black" />
                                        <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="black" />
                                        <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="black" />
                                        <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="black" />
                                        <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="black" />
                                    </svg>
                                </span>
                                <h2 id="typed"></h2>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <form id="formMoney" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Mã giao dịch</span>
                                    </label>
                                    <select onchange="getType(this);" class="form-select form-select-solid" data-control="select2" name="statusMDG" data-placeholder="Chọn thư mục cho Products">
                                        <option value="0">YES</option>
                                        <option value="1">NO</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Loại</span>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" name="type">
                                        <option value="+">Cộng</option>
                                        <option value="-">Trừ</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Thành viên</span>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" name="member" data-placeholder="Chọn thành viên">
                                        <option value="">Chọn thành viên</option>
                                        <?php foreach((new Controller)->get_list("SELECT * FROM `dga_users` ") as $row) { ?>
                                        <option value="<?=$row['username'];?>"><?=$row['username'];?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback">
                                    </div>
                                </div>
                                <div id="show">
                                </div>
                                <div class="separator mb-6"></div>
                                <div class="d-flex justify-content-end">
                                <a href="/dgaAdmin/home" class="btn btn-light me-3">Hủy</a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Thêm</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#formMoney').on('submit', function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        let contents = $(this).serialize();
        $.ajax({
            url: "/dgaAdmin/models/money",
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

    function getType(sel) {
        if (sel.value == 1) {
            $('#show').append('<div id="noMDG"> <div class="fv-row mb-7 fv-plugins-icon-container"> <label class="fs-6 fw-bold form-label mt-3"> <span class="required">Số tiền</span> </label> <input type="text" class="form-control form-control-solid" name="amount" value=""> <div class="fv-plugins-message-container invalid-feedback"></div></div> <div class="fv-row mb-7 fv-plugins-icon-container"> <label class="fs-6 fw-bold form-label mt-3"> <span class="required">Nội dung</span> </label> <input type="text" class="form-control form-control-solid" name="content" value=""> <div class="fv-plugins-message-container invalid-feedback"></div></div></div>');
            $('#yesMDG').remove();
            return false;
        } else {
            $('#show').append('<div id="yesMDG"> <div class="fv-row mb-7 fv-plugins-icon-container"> <label class="fs-6 fw-bold form-label mt-3"> <span class="required">MDG</span> </label> <input type="text" class="form-control form-control-solid" name="tranId" value=""> <div class="fv-plugins-message-container invalid-feedback"></div></div> <div class="fv-row mb-7 fv-plugins-icon-container"> <label class="fs-6 fw-bold form-label mt-3"> <span class="required">Số tiền</span> </label> <input type="text" class="form-control form-control-solid" name="amount" value=""/> <div class="fv-plugins-message-container invalid-feedback"></div></div><div class="fv-row mb-7 fv-plugins-icon-container"> <label class="fs-6 fw-bold form-label mt-3"> <span class="required">Ngân hàng</span> </label> <select class="form-select form-select-solid" data-control="select2" name="bank"> <option value="MOMO">MOMO</option> <option value="<?=(new Settings)->info('typeBank');?>"><?=(new Settings)->info('typeBank');?></option> </select> <div class="fv-plugins-message-container invalid-feedback"></div></div></div>');
            $('#noMDG').remove();
            return false;
        }
    }

    $(document).ready(function() {
        var typed = new Typed("#typed", {
            strings: ["Cộng tiền - Trừ tiền thành viên", "API nạp tiền lỗi điền mã giao dịch nhé !!"],
            typeSpeed: 50,
            loop: true,
            backDelay: 900,
            backSpeed: 30,
        });
    });

</script>
<?php require_once "./layouts/meta.php"; ?>