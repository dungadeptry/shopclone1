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

        $_SESSION['key'] = (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 264);
        $_SESSION['code'] = (new Func)->random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 4) . time();
        $amount = (new Func)->xss($_POST['amount']);
        $type = (new Func)->xss($_POST['type']);
        $check = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '$type' ");
        $user = new Users($_SESSION['username']);
        $price = $amount * $check['price'];
        if (empty($amount)) {
            (new Func)->responseForm1("Số lượng không được bỏ trống", "error");
        } else if (empty($type)) {
            (new Func)->responseForm1("Vui lòng chọn gói", "error");
        } else if (!$check) {
            (new Func)->responseForm1("Vui lòng chọn gói", "error");
        } else if ($amount <= 0) {
            (new Func)->responseForm1("Số lượng không hợp lệ", "error");
        } else if ($amount < $check['min']) {
            (new Func)->responseForm1("Số lượng mua tối thiểu là " . number_format($check['min']), "error");
        } else if ($amount > $check['max']) {
            (new Func)->responseForm1("Số lượng mua tối đa là " . number_format($check['max']), "error");
        } else if ($price > $user->info('money')) {
            (new Func)->responseForm1("Số dư không đủ để mua", "error");
        } else if ((new Controller)->num_rows("SELECT * FROM `dga_account` WHERE `product` = '" . $check['token'] . "' AND `status` = '1' AND `code` IS NULL") < $amount) {
            (new Func)->responseForm1("Số lượng không đủ", "error");
        } else {
            $_SESSION['total'] = 0;
            (new Order)->insertCheck($user->info('username'), $_SESSION['key'], $_SESSION['code'], $check['token'], $price, $amount);
            $product = json_encode(array('product' => $type, 'amount' => $amount, 'price' => $price));
            $_SESSION['product'] = $product;
            (new Func)->responseForm2("Hệ thống đang check live không được load lại trang", "success", $_SESSION['key']);
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
