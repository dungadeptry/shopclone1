<?php
require_once "../../controller/Connect.php";
require_once "../../models/Users.php";
require_once "../../models/Categorys.php";
require_once "../../models/Function.php";
require_once "../../class/Mobile_Detect.php";

if ($_POST) {

    if ((new Func)->middleware('isAdminReq') == true) {

        $type = (new Func)->xss($_POST['type']);
        if ($type == 'edit') {
            $name = (new Func)->xss($_POST['name']);
            $category = (new Func)->xss($_POST['category']);
            $id = (new Func)->xss($_POST['id']);
            $check = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `id` = '$id' ");
            if (empty($name)) {
                (new Func)->responseForm1("Tên danh mục không được bỏ trống", "error");
            }
            if (!$check) {
                (new Func)->responseForm1("Danh mục không có trong hệ thống", "error");
            }
            if (!($_FILE["thumb"]["name"])) {
                $rand = (new Func)->random("qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789", 16);
                $arr = explode(".", $_FILES["thumb"]["name"]);
                $uploads_dir = '../../storage/images';
                $url_thumb = "/" . $rand . "." . end($arr);
                move_uploaded_file($_FILES['thumb']['tmp_name'], $uploads_dir . $url_thumb);
                $thumb = "/storage/images" . $url_thumb;
            } else {
                $thumb = '';
            }
            (new Category)->editCategory($category, $thumb, $name, $id);
            (new Func)->responseForm1("Sửa thư mục " . $check['name'] . " thành " . $name . " thành công", "success");
        } else if ($type == 'remove') {
            $id = (new Func)->xss($_POST['id']);
            $check = (new Controller)->get_row("SELECT * FROM `dga_category` WHERE `id` = '$id' ");
            if (!$check) {
                (new Func)->responseForm1("Không tìm thấy thành viên", "error");
            } else {
                (new Category)->removeCategory($id);
                (new Func)->responseForm1("Xóa danh mục thành công", "success");
            }
        }
    } else {
        (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
    }
} else {
    (new Func)->responseForm1("Bạn không thể thực hiện bây giờ", "error");
}
