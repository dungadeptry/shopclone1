<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Accounts.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $product = (new Func)->xss($_POST['product']);
        $list = (new Func)->xss($_POST['list']);

        $list = explode(PHP_EOL, $list);

        $account = new Account();

        $value_add = 0;
        $value_update = 0;

        foreach($list as $clone)
        {
            if ($account->checkClone($clone) == true) {
                $account->insertAccount($product, $clone);
                $value_add++;
            } else {
                $account->updateAccount($product, $clone);
                $value_update++;
            }
        }

        (new Func)->responseForm1("Thêm $value_add tài khoản | Cập nhật $value_update tài khoản thành công", "success");
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
