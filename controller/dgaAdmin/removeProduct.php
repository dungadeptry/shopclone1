<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $id = (new Func)->xss($_POST['id']);
        $check = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '$id'");

        if (empty($id)) {
            (new Func)->responseForm1("Lỗi vui lòng thử lại", "error");
        } else if (!$check) {
            (new Func)->responseForm1("Sản phẩm không có trong hệ thống", "error");
        } else {
            (new Product)->removeProduct($id);
            (new Func)->responseForm1("Xóa sản phẩm ".$check['name']. " thành công", "success");

        }
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
