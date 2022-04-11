<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $name = (new Func)->xss($_POST['name']);
        $price = (new Func)->xss($_POST['price']);
        $details = (new Func)->xss($_POST['details']);
        $type = (new Func)->xss($_POST['type']);
        $min = (new Func)->xss($_POST['min']);
        $max = (new Func)->xss($_POST['max']);
        $category = (new Func)->xss($_POST['category']);

        if (empty($name)) {
            (new Func)->responseForm1("Tên sản phẩm không được bỏ trống", "error");
        } else if (empty($price)) {
            (new Func)->responseForm1("Giá sản phẩm không được bỏ trống", "error");
        } else if (empty($type)) {
            (new Func)->responseForm1("Loại sản phẩm không được bỏ trống", "error");
        } else if (empty($min) || empty($max)) {
            (new Func)->responseForm1("Mua tối thiểu và mua tối đa không được bỏ trống", "error");
        } else {
            (new Product)->insertProduct($name, $category, $price, $details, $min, $max, $type);
            (new Func)->responseForm1("Thêm sản phẩm ".$name. " thành công", "success");

        }
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
