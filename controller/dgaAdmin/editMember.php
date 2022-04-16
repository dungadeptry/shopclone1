<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $type = (new Func)->xss($_POST['type']);

        if ($type == 'edit') {
            $username = (new Func)->xss($_POST['username']);
            $money = (new Func)->xss($_POST['money']);
            $total_money = (new Func)->xss($_POST['total_money']);
            $used_money = (new Func)->xss($_POST['used_money']);
            $level = (new Func)->xss($_POST['level']);
            $status = (new Func)->xss($_POST['status']);
            $check = (new Controller)->get_row("SELECT * FROM `dga_users` WHERE `username` = '$username' ");
            if (!$check) {
                (new Func)->responseForm1("Không tìm thấy thành viên", "error");
            } else if ($money < 0) {
                (new Func)->responseForm1("Số dư không hợp lệ", "error");
            } else {
                $user = new Users($check['username']);
                $user->saveUser($money, $total_money, $used_money, $level, $status);
                (new Func)->responseForm1("Thay đổi thành công", "success");
            }
        } else if ($type == 'remove') {
            $id = (new Func)->xss($_POST['id']);
            $check = (new Controller)->get_row("SELECT * FROM `dga_users` WHERE `id` = '$id' ");
            $user = new Users($check['username']);
            if (!$check) {
                (new Func)->responseForm1("Không tìm thấy thành viên", "error");
            } else {
                $user->removeUser($id);
                (new Func)->responseForm1("Xóa thành viên thành công", "success");
            }
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
