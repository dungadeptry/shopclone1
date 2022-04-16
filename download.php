<?php

require_once "./controller/Connect.php";
require_once "./models/Function.php";

if ($_GET['id']) {
    $order = (new Controller)->get_row("SELECT * FROM `dga_orders` WHERE `code` = '" . (new Func)->xss($_GET['id']) . "' ");
    $account = (new Controller)->get_list("SELECT * FROM `dga_account` WHERE `keyBuy` = '" . $order['keyBuy'] . "' AND `code` IS NOT NULL AND `status` = '1' ");
    $product = (new Controller)->get_row("SELECT * FROM `dga_product` WHERE `token` = '" . $order['product'] . "'")['name'];
    $code = $order['code'];
    $clone = 'DỊCH VỤ: '.$product.' SỐ LƯỢNG: '.$order['amount'].' | GIÁ: '.number_format($order['amount']).' VNĐ';
    if (!$account) {
    } else {
        foreach ($account as $row1) {
            $clone = $clone . PHP_EOL . htmlspecialchars_decode($row1['details']);
        }
    }
    $file = $code . ".txt";
    $txt = fopen($file, "w") or die("Unable to open file!");
    fwrite($txt, $clone);
    fclose($txt);
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/plain");
    readfile($file);
    unlink($code . ".txt");
}
