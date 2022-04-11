<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Categorys.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {
        $user = new Users($_SESSION['username']);
        $arranges = $_POST['arrange'];
        $i = 0;
        foreach ($arranges as $arrange) {
            $check = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `id` = '$arrange' ");
            (new Category)->arrange($check['id'], $i++);
        }

        (new Func)->responseForm1("Sắp xếp thành công", "success");
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
