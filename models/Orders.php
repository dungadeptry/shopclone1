<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Order extends Controller
{


    public function insertCheck($username, $keyBuy, $code, $product, $price, $amount) 
    {
        $this->insert('dga_orders', [
            'code' => $code,
            'username' => $username,
            'keyBuy' => $keyBuy,
            'product' => $product,
            'price' => $price,
            'amount' => $amount,
            'created_at' => $this->gettime()
        ]);
    }


    public function updateCheck($status, $keyBuy) 
    {
        $this->update("dga_orders", array(
            'status' => $status,
            'updated_at' => $this->gettime(),
        ), " `keyBuy` = '$keyBuy' ");
    }



}