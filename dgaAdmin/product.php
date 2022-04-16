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
                                <h2>Thêm sản phẩm</h2>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <form id="addProduct" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Thư mục</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha" aria-label="Thư mục cha để rỗng - thư mục con thì lựa thư mục cha"></i>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2" name="category">
                                        <option value="0">Thư mục</option>
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
                                    <input type="text" class="form-control form-control-solid" name="name" value="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Giá</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" name="price" value="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">MÔ TẢ</span>
                                    </label>
                                    <textarea rows="2" type="text" class="form-control form-control-solid" name="details"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">THỂ LOẠI</span>
                                    </label>
                                    <select class="form-select form-select-solid" name="type">
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
                                            <input type="number" class="form-control form-control-solid" name="min" value="">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fv-row mb-7">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span>Mua tối đa</span>
                                            </label>
                                            <input type="number" class="form-control form-control-solid" name="max" value="">
                                        </div>
                                    </div>
                                </div>



                                <div class="separator mb-6"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="/dgaAdmin/edit-product" class="btn btn-info w-100 me-3">Sửa sản phẩm</a>
                                    <a href="/dgaAdmin/home" class="btn btn-light me-3">Hủy</a>
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
                                        <th>SẢN PHẨM</th>
                                        <th>GIÁ</th>
                                        <th>MIN</th>
                                        <th>MAX</th>
                                        <th>ĐÃ BÁN</th>
                                        <th>NGÀY TẠO</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((new Controller)->get_list("SELECT * FROM `dga_product` ORDER BY `arrange` ASC") as $row) { ?>
                                        <tr>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= number_format($row['price']); ?></td>
                                            <td><?= number_format($row['min']); ?></td>
                                            <td><?= number_format($row['max']); ?></td>
                                            <td><?= number_format($row['sold']); ?></td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td><a onclick="remove(<?= $row['id']; ?>)" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">Xóa</a>
                                                <a href="/dgaAdmin/edit-product?id=<?= $row['id']; ?>" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary">Sửa</a>
                                                <a href="/dgaAdmin/clone?id=<?= $row['id']; ?>" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-active-light-warning">Xem Clone</a>
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
    function remove(id) {
        Swal.fire({
            title: "Chắc chắn chứ?",
            text: "Bạn xác nhận xóa sản phẩm này ra khỏi hệ thống?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/dgaAdmin/models/removeProduct",
                    type: "POST",
                    data: {
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
    $('#addProduct').on('submit', function() {
        $.ajax({
            url: "/dgaAdmin/models/addProduct",
            method: "POST",
            dataType: "JSON",
            data: $(this).serialize(),
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
</script>
<?php require_once "./layouts/meta.php"; ?>