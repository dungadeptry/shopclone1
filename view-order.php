<?php 

require_once "./controller/Connect.php";
require_once "./models/Function.php";

if ($_GET['id']) { 
    $order = (new Controller)->get_row("SELECT * FROM `dga_orders` WHERE `id` = '" . (new Func)->xss($_GET['id']) . "' ");
    $account = (new Controller)->get_list("SELECT * FROM `dga_account` WHERE `keyBuy` = '".$order['keyBuy']."' AND `code` IS NOT NULL AND `status` = '1' ");
?>

<?php if ($account) { ?>
<textarea class="form-control" rows="12">
<?php foreach($account as $acc) { ?>
<?=$acc['details']; ?> 
<?php } ?>
</textarea></br>
<?php } else { ?>
    <h4>Không có dữ liệu<h4>
<?php } }?>
