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
        $key = (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 264);
        $code = (new Func)->random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 4) . time();
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
            $account = 0;
            foreach ((new Controller)->get_list("SELECT * FROM `dga_account` WHERE `product` = '" . $check['token'] . "' AND `code` IS NULL AND `status` = '1' ORDER BY `id` DESC ") as $row) {
                if ($check['type'] == 'CLONE') {
                    if ((new Controller)->num_rows("SELECT * FROM `dga_account` WHERE `product` = '" . $check['token'] . "' AND `status` = '1' AND `code` IS NULL") < $amount) {
                        (new Func)->responseForm1("Số lượng không đủ", "error");
                    } else {
                        if ($row) {
                            if ($account == $amount) {
                                break;
                            }
                            $uid = explode('|', $row['details'])[0];
                            $status = (new Func)->checkLiveClone($uid);
                            if ($status == 'LIVE') {
                                $account++;
                                (new Account)->updateAccountBuy($row['id'], 1, $key);
                            } else {
                                (new Account)->updateAccountBuy($row['id'], 0, $key);
                            }
                        }
                    }
                } 
            }

            if ($account < $amount) {
                (new Func)->responseForm1("Số lượng không đủ", "error");
            } else {
                (new Order)->updateCheck(1, $_SESSION['key']);
                $user = new Users($_SESSION['username']);
                $history = new History($_SESSION['username']);
                $history->save($user->info('money'), $product['price'], $user->info('money') - $product['price'], 'Mua ' . $product['amount'] . ' ' . $check['name'] . ' với giá ' . number_format($product['price']));
                $user->saveBuy($product['price']);
                if ($user->info('money') < 0) {
                    (new Controller)->query("UPDATE `dga_users` SET `banned` = '1' WHERE `username` = '" . $user->username . "' ");
                } else {
                    (new Order)->insertCheck($user->info('username'), $key, $code, $check['token'], $price, $amount);
                    (new Account)->updateAccountDone($code, $key);
                    (new Func)->responseForm2("Mua thành công", "success", $code);
                }
            }
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
