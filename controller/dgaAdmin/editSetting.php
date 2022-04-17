<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Products.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {



        foreach ($_POST as $key => $value) {
            (new Controller)->query("UPDATE `dga_setting` SET `$key` = '$value' WHERE `id` = '1' ");
        }

        if (!($_FILE["logo"]["name"])) {
            $arr = explode(".", $_FILES["logo"]["name"]);
            if (!empty(end($arr))) {
            $uploads_dir = '../../storage/images';
            $url_thumb = "/logo.". end($arr);
            move_uploaded_file($_FILES['logo']['tmp_name'], $uploads_dir . $url_thumb);
            $logo = "/storage/images".$url_thumb;
            (new Controller)->query("UPDATE `dga_setting` SET `logo` = '$logo' WHERE `id` = '1' ");
            }
        } 
        if (!($_FILE["favicon"]["name"])) {
            $arr = explode(".", $_FILES["favicon"]["name"]);
            if (!empty(end($arr))) {
            $uploads_dir = '../../storage/images';
            $url_thumb = "/favicon.". end($arr);
            move_uploaded_file($_FILES['favicon']['tmp_name'], $uploads_dir . $url_thumb);
            $favicon = "/storage/images".$url_thumb;
            (new Controller)->query("UPDATE `dga_setting` SET `favicon` = '$favicon' WHERE `id` = '1' ");
            }
        } 
        if (!($_FILE["background"]["name"])) {
            if (!empty(end($arr))) {
            $arr = explode(".", $_FILES["background"]["name"]);
            $uploads_dir = '../../storage/images';
            $url_thumb = "/background.". end($arr);
            move_uploaded_file($_FILES['background']['tmp_name'], $uploads_dir . $url_thumb);
            $background = "/storage/images".$url_thumb;
            (new Controller)->query("UPDATE `dga_setting` SET `background` = '$background' WHERE `id` = '1' ");
            }
        } 
        (new Func)->responseForm1("Chỉnh sửa thành công", "success");
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
