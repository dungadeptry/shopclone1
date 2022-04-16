<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {
        foreach ($_POST as $key => $value) {
            (new Controller)->query("UPDATE `dga_setting` SET `$key` = '$value' WHERE `id` = '1' ");
        }
        (new Func)->responseForm1("Chỉnh sửa thành công", "success");
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
