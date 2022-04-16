<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $type = (new Func)->xss($_POST['type']);
        $name = (new Func)->xss($_POST['name']);
        $category = (new Func)->xss($_POST['category']);
        $id = (new Func)->xss($_POST['id']);
        $price = (new Func)->xss($_POST['price']);
        $details = (new Func)->xss($_POST['details']);
        $min = (new Func)->xss($_POST['min']);
        $max = (new Func)->xss($_POST['max']);
        $check = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '$id' ");
        if (empty($name)) {
            (new Func)->responseForm1("Tên sản phẩm không được bỏ trống", "error");
        } else if (empty($price)) {
            (new Func)->responseForm1("Giá sản phẩm không được bỏ trống", "error");
        } else if (empty($type)) {
            (new Func)->responseForm1("Loại sản phẩm không được bỏ trống", "error");
        } else if (empty($min) || empty($max)) {
            (new Func)->responseForm1("Mua tối thiểu và mua tối đa không được bỏ trống", "error");
        } else if (!$check) {
            (new Func)->responseForm1("Sản phẩm không có trong hệ thống", "error");
        } else {
            (new Product)->editProduct($name, $category, $price, $details, $min, $max, $type, $id);
            (new Func)->responseForm1("Sửa Sản phẩm " . $check['name'] . " thành " . $name . " thành công", "success");
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
