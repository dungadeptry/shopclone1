<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Account extends Controller
{

    public function checkClone($clone)
    {
        if ($this->num_rows(" SELECT * FROM `dga_account` WHERE `details` = '$clone' ") == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertAccount($product, $clone)
    {
        $this->insert("dga_account", [
            'details' => $clone,
            'product' => $product,
            'status' => 1,
            'created_at' => $this->gettime()
        ]);
    }


    public function updateAccount($product, $clone)
    {
        $id = $this->get_row(" SELECT * FROM `dga_account` WHERE `details` = '$clone' AND `code` IS NULL ")['id'];
        $this->update("dga_account", array(
            'details' => $clone,
            'product' => $product,
            'status' => 1,
            'keyBuy' => null,
            'updated_at' => $this->gettime()
        ), " `id` = '" . $id . "' ");
    }

    public function updateAccountBuy($id, $code, $username, $status, $keyBuy)
    {
        if ($code == NULL) {
            $this->update("dga_account", array(
                'status' => $status,
                'keyBuy' => $keyBuy,
                'updated_at' => $this->gettime(),
            ), " `id` = '$id' ");
        } else {
            $this->update("dga_account", array(
                'code' => $code,
                'username' => $username,
                'status' => $status,
                'keyBuy' => $keyBuy,
                'updated_at' => $this->gettime(),
            ), " `id` = '$id' ");
        }
    }

    public function updateAccountDone($code, $key)
    {
        foreach ($this->get_list("SELECT * FROM `dga_account` WHERE `keyBuy` = '$key' AND `status` = '1' AND `code` IS NULL ") as $row) {
            $this->update("dga_account", array(
                'code' => $code,
                'updated_at' => $this->gettime(),
            ), " `id` = '".$row['id']."' ");
        }
        $this->update("dga_orders", array(
            'status' => 2, // XONG
            'updated_at' => $this->gettime(),
        ), " `code` = '$code' ");
    }
}
