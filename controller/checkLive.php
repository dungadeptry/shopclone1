<?php
require_once "../controller/Connect.php";
require_once "../models/Accounts.php";
require_once "../models/Function.php";
require_once "../models/History.php";
require_once "../models/Orders.php";
require_once "../class/Mobile_Detect.php";
require_once "../models/Users.php";

if ($_POST) {

    if ((new Func)->middleware('isUserReq') == true) {

        $author = (new Func)->xss($_POST['author']);
        $product = json_decode($_SESSION['product'], true);
        $check = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `id` = '" . $product['product'] . "' ");
        $_SESSION['exist'] = $product['amount'] - $_SESSION['total'];
        if (empty($author)) {
            (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
        } else {
            if ($_SESSION['total'] > $product['amount']) {
                $_SESSION['total'] = 0;
            }
            if ($_SESSION['exist'] > 0) {
                if ((new Controller)->num_rows("SELECT * FROM `dga_account` WHERE `product` = '" . $check['token'] . "' AND `code` IS NULL AND `keyBuy` IS NULL AND `status` = '1'") >= ($product['amount'] - $_SESSION['total'])) {
                    if ($check['type'] == 'CLONE') {
                        $acc = (new Controller)->get_row("SELECT * FROM `dga_account` WHERE `product` = '" . $check['token'] . "' AND `code` IS NULL AND `keyBuy` IS NULL AND `status` = '1' ORDER BY RAND() LIMIT 1");
                        if ($acc) {
                            $uid = explode('|', $acc['details'])[0];
                            $status = (new Func)->checkLiveClone($uid);
                            if ($status == 'LIVE') {
                                $_SESSION['total'] = $_SESSION['total'] + 1;
                                $_SESSION['exist'] = $product['amount'] - $_SESSION['total'];
                                (new Account)->updateAccountBuy($acc['id'], NULL, NULL, 1, $_SESSION['key']);
                                (new Func)->responseForm1("Clone live còn lại: ".$product['amount'] - $_SESSION['total'], "success");
                            } else {
                                (new Account)->updateAccountBuy($acc['id'], NULL, NULL, 0, $_SESSION['key']);
                                (new Func)->responseForm1("Clone die đang đổi clone", "error");
                            }
                        }
                    }
                } else {
                    (new Order)->updateCheck(3, $_SESSION['key']);
                    (new Func)->responseForm1("Số lượng không đủ", "insufficient");
                }
            } else {
                (new Order)->updateCheck(1, $_SESSION['key']);
                $user = new Users($_SESSION['username']);
                $history = new History($_SESSION['username']);
                $history->save($user->info('money'), $product['price'], $user->info('money') - $product['price'], 'Mua '.$product['amount'].' '.$check['name'].' với giá '.number_format($product['price']));
                $user->saveBuy($product['price']);
                $_SESSION['total'] = 0;
                (new Func)->responseForm1("Đã xong đợi xuất clone", "done");
            }
        }
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
