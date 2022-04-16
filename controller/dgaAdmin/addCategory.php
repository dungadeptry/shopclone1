<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Categorys.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $name = (new Func)->xss($_POST['name']);
        $category = (new Func)->xss($_POST['category']);

        if (empty($name)) {
            (new Func)->responseForm1("Tên danh mục không được bỏ trống", "error");
        }
        if (!($_FILE["thumb"]["name"])) {
            $rand = (new Func)->random("qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789", 16);
            $arr = explode(".", $_FILES["thumb"]["name"]);
            $uploads_dir = '../../storage/images';
            $url_thumb = "/" . $rand . "." . end($arr);
            move_uploaded_file($_FILES['thumb']['tmp_name'], $uploads_dir . $url_thumb);
            $thumb = "/storage/images".$url_thumb;
        } else {
            $thumb = '';
        }

        if ($category == 0) {
            (new Category)->insertFather($name, $thumb);
        } else {
            (new Category)->insertChild($name, $thumb, $category);
        }
        (new Func)->responseForm1("Thêm thư mục ".$name. " thành công", "success");
        
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
