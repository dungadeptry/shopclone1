<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Banks.php";
require_once "../../models/History.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $type = (new Func)->xss($_POST['type']);
        $member = (new Func)->xss($_POST['member']);
        $statusMDG = (new Func)->xss($_POST['statusMDG']);
        if (empty($member)) {
            (new Func)->responseForm1("Thành viên không được bỏ trống", "error");
        } else {
            if ($statusMDG == '0') {
                $tranId = (new Func)->xss($_POST['tranId']);
                $amount = (new Func)->xss($_POST['amount']);
                $bank = (new Func)->xss($_POST['bank']);
                if ($amount < 0) {
                    (new Func)->responseForm1("Số tiền không hợp lệ", "error");
                } else if (empty($tranId)) {
                    (new Func)->responseForm1("Vui lòng nhập mã giao dịch", "error");
                } else if (empty($bank)) {
                    (new Func)->responseForm1("Vui lòng chọn ngân hàng", "error");
                } else if (empty($amount)) {
                    (new Func)->responseForm1("Vui lòng nhập số tiền cần cộng", "error");
                } else if ((new Controller)->get_row("SELECT * FROM `dga_bank` WHERE `tranId` = '$tranId'")) {
                    (new Func)->responseForm1("Mã giao dịch đã có trong hệ thống", "error");
                } else {
                    $user = new Users($member);
                    $history = new History($_SESSION['username']);
                    $history->save($user->info('money'), $amount, $user->info('money') + $amount, 'Nạp tiền vào tài khoản MOMO(' . $tranId . ')');
                    $amountChange = $type . $amount;
                    $user->saveRecharge($amountChange);
                    (new Bank)->insertBankAdmin($user->info('username'), $amount, $tranId, $bank);
                    (new Func)->responseForm1("Thao tác thành công cho " . $user->info('username') . " thành công!", "success");
                }
            } else if ($statusMDG == 1) {
                $amount = (new Func)->xss($_POST['amount']);
                $content = (new Func)->xss($_POST['content']);
                if ($amount < 0) {
                    (new Func)->responseForm1("Số tiền không hợp lệ", "error");
                } else {
                    $user = new Users($member);
                    $history = new History($_SESSION['username']);
                    $history->save($user->info('money'), $amount, $user->info('money') + $amount, $content);
                    $amountChange = $type . $amount;
                    $user->saveRecharge($amountChange);
                    (new Func)->responseForm1("Thao tác thành công cho " . $user->info('username') . " thành công!", "success");
                }
            }
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
