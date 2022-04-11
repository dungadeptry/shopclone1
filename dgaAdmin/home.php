<?php
require_once "../controller/Connect.php";
require_once "../models/Settings.php";
require_once "../models/Users.php";
require_once "../models/Function.php";
(new Func)->middleware('auth');
(new Func)->middleware('isAdmin');
$title = 'Trang chủ';
require_once "./layouts/head.php";
require_once "./layouts/nav.php";
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_users` ")); ?></span>
                                <div class="m-0">
                                    <span class="fw-bold fs-6 text-gray-400">Tổng thành viên</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="black" />
                                        <path d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format((new Controller)->get_row("SELECT SUM(`money`) FROM `dga_users` ")['SUM(`money`)']); ?></span>
                                <div class="m-0">
                                    <span class="fw-bold fs-6 text-gray-400">Tổng số dư</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                        <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                        <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_orders` ")); ?></span>
                                <div class="m-0">
                                    <span class="fw-bold fs-6 text-gray-400">Tổng đơn</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-6">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Thông Số</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Thông số ngày - tháng - năm</span>
                            </h3>
                        </div>
                        <div class="card-body pt-9 pb-5">
                            <div class="tns">
                                <div data-tns="true" data-tns-nav-position="bottom" data-tns-controls="false">
                                    <div class="mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 my-0">
                                                <thead>
                                                    <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                        <th class="p-0 w-50px pb-1"></th>
                                                        <th class="ps-0 min-w-140px">THÔNG SỐ NGÀY</th>
                                                        <th class="text-end min-w-140px p-0 pb-1">KẾT QUẢ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền nạp</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format(
                                                                                                                                    (new Controller)->get_row("SELECT SUM(`amount`) FROM `dga_bank` WHERE `created_at` >= DATE(NOW()) AND `created_at` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] +
                                                                                                                                        (new Controller)->get_row("SELECT SUM(`received`) FROM `dga_card` WHERE `status` = '0' AND `created_at` >= DATE(NOW()) AND `created_at` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`received`)']
                                                                                                                                ); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền tiêu</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format(
                                                                                                                                    (new Controller)->get_row("SELECT SUM(`price`) FROM `dga_orders` WHERE `created_at` >= DATE(NOW()) AND `created_at` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`price`)']
                                                                                                                                ); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-user-group-man-man.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng thành viên đăng ký</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_users` WHERE `created_at` >= DATE(NOW()) AND `created_at` < DATE(NOW()) + INTERVAL 1 DAY ")); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-shopping-cart.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng đơn </a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_orders` WHERE `created_at` >= DATE(NOW()) AND `created_at` < DATE(NOW()) + INTERVAL 1 DAY ")); ?></span>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 my-0">
                                                <thead>
                                                    <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                        <th class="p-0 w-50px pb-1"></th>
                                                        <th class="ps-0 min-w-140px">THÔNG SỐ TUẦN</th>
                                                        <th class="text-end min-w-140px p-0 pb-1">KẾT QUẢ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền nạp</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format(
                                                                                                                                    (new Controller)->get_row("SELECT SUM(`amount`) FROM `dga_bank` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ")['SUM(`amount`)'] +
                                                                                                                                        (new Controller)->get_row("SELECT SUM(`received`) FROM `dga_card` WHERE `status` = '1' AND WEEK(created_at, 1) = WEEK(CURDATE(), 1) ")['SUM(`received`)']
                                                                                                                                ); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền tiêu</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->get_row("SELECT SUM(`price`) FROM `dga_orders` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ")['SUM(`price`)']); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-user-group-man-man.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng thành viên đăng ký</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_users` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ")); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-shopping-cart.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng đơn</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_orders` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ")); ?></span>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 my-0">
                                                <thead>
                                                    <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                        <th class="p-0 w-50px pb-1"></th>
                                                        <th class="ps-0 min-w-140px">THÔNG SỐ TUẦN</th>
                                                        <th class="text-end min-w-140px p-0 pb-1">KẾT QUẢ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền nạp</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format(
                                                                                                                                    (new Controller)->get_row("SELECT SUM(`amount`) FROM `dga_bank` WHERE YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`amount`)'] +
                                                                                                                                        (new Controller)->get_row("SELECT SUM(`received`) FROM `dga_card` WHERE `status` = '1' AND YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`received`)']
                                                                                                                                ); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/stack-of-coins.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng tiền tiêu</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->get_row("SELECT SUM(`price`) FROM `dga_orders` WHERE YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`price`)']); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-user-group-man-man.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng thành viên đăng ký</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_users` WHERE YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <img src="https://img.icons8.com/fluency/48/000000/add-shopping-cart.png" class="w-35px" alt="">
                                                        </td>
                                                        <td class="ps-0">
                                                            <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Tổng đơn</a>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end"><?= number_format((new Controller)->num_rows("SELECT * FROM `dga_orders` WHERE YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")); ?></span>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Thông Số Nạp Tiền</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Thông số nạp tiền trong 1 tháng</span>
                            </h3>
                        </div>
                        <div class="card-body pt-9 pb-5">
                            <canvas id="dga_chartrecharge" class="mh-400px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Nạp tiền - Chi tiêu</span>
                                <span class="text-gray-400 pt-2 fw-bold fs-6">Tổng số dư: <b class="text-danger"> <?= number_format((new Controller)->get_row("SELECT SUM(`money`) FROM `dga_users` ")['SUM(`money`)']); ?></b></span>
                            </h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
                        <div class="card-body pt-0 px-0">
                            <div id="dga_chart" class="min-h-auto ps-4 pe-6 mb-3" style="height: 350px; min-height: 365px;">
                            </div>
                            <div class="d-flex align-items-center px-9">
                                <div class="d-flex align-items-center me-6">
                                    <span class="rounded-1 bg-primary me-2 h-10px w-10px"></span>
                                    <span class="fw-bold fs-6 text-gray-600">Nạp tiền</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="rounded-1 bg-success me-2 h-10px w-10px"></span>
                                    <span class="fw-bold fs-6 text-gray-600">Chi tiêu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var ctx = document.getElementById('dga_chartrecharge');

        // Define colors
        var primaryColor = KTUtil.getCssVariableValue('--bs-primary');
        var dangerColor = KTUtil.getCssVariableValue('--bs-danger');
        var successColor = KTUtil.getCssVariableValue('--bs-success');
        var warningColor = KTUtil.getCssVariableValue('--bs-warning');
        var infoColor = KTUtil.getCssVariableValue('--bs-info');

        // Define fonts
        var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

        // Chart labels
        const labels = ['ATM', 'MOMO', 'CARD'];

        // Chart data
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [
                        <?=(new Controller)->get_row("SELECT SUM(`amount`) FROM `dga_bank` WHERE `type` != 'MOMO' AND `type` != 'THESIEURE' AND YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`amount`)'];?>,
                        <?=(new Controller)->get_row("SELECT SUM(`amount`) FROM `dga_bank` WHERE `type` = 'MOMO' OR `type` = 'THESIEURE' AND YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`amount`)'];?>,
                        <?=(new Controller)->get_row("SELECT SUM(`received`) FROM `dga_card` WHERE `status` = '0' AND YEAR(created_at) = " . date('Y') . " AND MONTH(created_at) = " . date('m') . " ")['SUM(`received`)'];?>
                    ],
                    backgroundColor: [primaryColor, dangerColor, successColor]
                },
            ]
        };

        // Chart config
        const config = {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: false,
                    }
                },
                responsive: true,
            },
            defaults: {
                global: {
                    defaultFont: fontFamily
                }
            }
        };

        var myChart = new Chart(ctx, config);

        var element = document.getElementById('dga_chart');

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
        var successColor = KTUtil.getCssVariableValue('--bs-success');

        if (!element) {
            return;
        }

        var options = {
            series: [{
                    name: "Nạp tiêu",
                    data: [<?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '6', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '5', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '4', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '3', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '2', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', (new Func)->calDate('-', '1', 'day'))); ?>, <?= (new Func)->calTotalRecharge(date('d', time())); ?>]
                },
                {
                    name: "Chi tiêu",
                    data: [-<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '6', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '5', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '4', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '3', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '2', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', (new Func)->calDate('-', '1', 'day'))); ?>, -<?= (new Func)->calTotalSpending(date('d', time())); ?>]
                },
            ],
            chart: {
                fontFamily: "Fira Sans",
                type: "bar",
                stacked: !0,
                height: height,
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: "35%",
                    barHeight: "70%",
                    borderRadius: [6, 6]
                }
            },
            legend: {
                show: !1
            },
            dataLabels: {
                enabled: !1
            },
            xaxis: {
                categories: ["<?= (new Func)->calDateDay('-', '6'); ?>", "<?= (new Func)->calDateDay('-', '5'); ?>", "<?= (new Func)->calDateDay('-', '4'); ?>", "<?= (new Func)->calDateDay('-', '3'); ?>", "<?= (new Func)->calDateDay('-', '2'); ?>", "<?= (new Func)->calDateDay('-', '1'); ?>", "<?= date('Y-m-d', time()); ?>"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                tickAmount: 10,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: "12px"
                    }
                },
                crosshairs: {
                    show: !1
                },
            },
            yaxis: {
                min: -100,
                max: 100,
                tickAmount: 6,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: "12px"
                    },
                    formatter: function(e) {
                        return parseInt(e) + "K";
                    },
                },
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: !1,
                    filter: {
                        type: "none",
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: "12px",
                    borderRadius: 4
                },
                y: {
                    formatter: function(e) {
                        return e > 0 ? e + "K" : Math.abs(e) + "K";
                    },
                },
            },
            colors: [baseColor, successColor],
            grid: {
                borderColor: secondaryColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: !0
                    }
                }
            },
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    });
</script>
<?php require_once "./layouts/meta.php"; ?>