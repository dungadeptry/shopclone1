<?php
require_once "../controller/Connect.php";
require_once "../models/Users.php";
require_once "../models/History.php";
require_once "../models/Function.php";
require_once "../class/Mobile_Detect.php";

if ($_POST) {
    
    $username = (new Func)->xss($_POST['username']);
    $password = (new Func)->xss($_POST['password']);
    $confpassword = (new Func)->xss($_POST['confpassword']);

    if (empty($username)) {
        (new Func)->responseForm1("Tài khoản không được bỏ trống", "error");
    } else if (empty($password)) {
        (new Func)->responseForm1("Mật khẩu không được bỏ trống", "error");
    } else if (empty($confpassword)) {
        (new Func)->responseForm1("Vui lòng nhập lại mật khẩu", "error");
    } else if ($password != $confpassword) {
        (new Func)->responseForm1("Nhập lại mật khẩu không chính xác", "error");
     } else if ((new Controller)->get_row("SELECT * FROM `dga_users` WHERE `username` = '$username' ")) {
        (new Func)->responseForm1("Tài khoản đã có trong hệ thống", "error");
     } else if ((new Controller)->num_rows("SELECT * FROM `dga_users` WHERE `ip` = '".(new Func)->myip()."' ") >= 3) {
        (new Func)->responseForm1("Đã đạt đến giới hạn tạo tài khoản", "error");
     } else {
        $_SESSION['username'] = $username;
        $user = new Users($username);
        $user->insertUser($username, $password);
        $history = new History($username);
        $history = $history->save(0, 0, 0, "Đăng ký vào hệ thống IP: ".(new Func)->myip());
        (new Func)->responseForm1("Đăng ký thành công", "success");
    }
    
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}