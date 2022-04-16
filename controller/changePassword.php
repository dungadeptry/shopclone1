<?php
require_once "../controller/Connect.php";
require_once "../models/Users.php";
require_once "../models/History.php";
require_once "../models/Orders.php";
require_once "../models/Accounts.php";
require_once "../models/Function.php";
require_once "../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isUserReq') == true) {  
        $user= new Users($_SESSION['username']);
        $old_password = md5((new Func)->xss($_POST['old_password']));
        $password = (new Func)->xss($_POST['password']);
        $re_password = (new Func)->xss($_POST['re_password']);
        if (!(new Controller)->get_row("SELECT * FROM `dga_users` WHERE `username` = '".$user->info('username')."' AND `password` = '$old_password' ")) {
            (new Func)->responseForm1("Mật khẩu cũ không chính xác", "error");
        } else if ($user->info('password') != $old_password) {
            (new Func)->responseForm1("Mật khẩu cũ không chính xác", "error");
        } else if ($user->info('banned') == 1) {
            (new Func)->responseForm1("Tài khoản của bạn đã bị khóa", "error");
        } else if ($password != $re_password) {
            (new Func)->responseForm1("Nhập lại mật khẩu không chính xác", "error");
        } else {
            $user->savePasssword($password);
            $history = new History($_SESSION['username']);
            $history->save($user->info('money'), 0, 0, 'Đổi mật khẩu tại ip: '.(new Func)->myip());
            (new Func)->responseForm1("Đổi mật khẩu thành công", "success");
        }
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
