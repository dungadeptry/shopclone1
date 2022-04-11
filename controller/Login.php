<?php
require_once "../controller/Connect.php";
require_once "../models/Users.php";
require_once "../models/History.php";
require_once "../models/Function.php";
require_once "../class/Mobile_Detect.php";

if ($_POST) {
    
    $username = (new Func)->xss($_POST['username']);
    $password = md5((new Func)->xss($_POST['password']));

    if (empty($username)) {
        (new Func)->responseForm1("Tài khoản không được bỏ trống", "error");
    } else if (empty($password)) {
        (new Func)->responseForm1("Mật khẩu không được bỏ trống", "error");
    } else if (mysqli_num_rows((new Func)->query("SELECT * FROM `dga_users` WHERE `username` = '$username' ")) <= 0) {
        (new Func)->responseForm1("Tài khoản không có trong hệ thống", "error");
    } else if (mysqli_fetch_assoc((new Func)->query("SELECT * FROM `dga_users` WHERE `username` = '$username' "))['banned'] == 1) {
        (new Func)->responseForm1("Tài khoản của bạn đã bị vô hiệu hóa", "error");
    } else if (mysqli_fetch_assoc((new Func)->query("SELECT * FROM `dga_users` WHERE `username` = '$username' "))['password'] != $password) {
        (new Func)->responseForm1("Mật khẩu không chính xác vui lòng thử lại", "error");
    } else {
        $_SESSION['username'] = $username;
        $user = new Users($username);
        $user->saveLogin();
        $history = new History($username);
        $history = $history->save(0, 0, 0, "Đăng nhập vào hệ thống IP: ".(new Func)->myip());
        (new Func)->responseForm1("Đăng nhập thành công", "success");
    }
    
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}