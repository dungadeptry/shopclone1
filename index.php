<?php

require_once "./controller/Connect.php";
require_once "./models/Accounts.php";
if ($_GET['act']) {
    $act = $_GET['act'];
    if ($act == 'login' || $act == 'register') {
        require_once "./models/Settings.php";
        require_once "./models/Function.php";
        (new Func)->middleware('guest');
        require_once "./public/layouts/head.php";
        require_once "./public/auth/" . $act . ".php";
    } else {
        require_once "./models/Settings.php";
        require_once "./models/Users.php";
        require_once "./models/Function.php";
        (new Func)->middleware('auth');
        $user = new Users($_SESSION['username']);
        require_once "./public/layouts/head.php";
        require_once "./public/layouts/nav.php";
        require_once "./public/view/" . $act . ".php";
        require_once "./public/layouts/foot.php";
        require_once "./public/layouts/meta.php";
    }
} else {
    require_once "./models/Settings.php";
    require_once "./models/Users.php";
    require_once "./models/Function.php";
    (new Func)->middleware('auth');
    $user = new Users($_SESSION['username']);
    require_once "./public/layouts/head.php";
    require_once "./public/layouts/nav.php";
    require_once "./public/view/home.php";
    require_once "./public/layouts/foot.php";
    require_once "./public/layouts/meta.php";
}
