<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Product extends Controller
{

    public function arrange($id, $stt)
    {
        $this->update("dga_product", array(
            'arrange' => $stt,
        ), " `id` = '$id' ");
    }

    public function insertProduct($name, $category, $price, $details, $min, $max, $type)
    {
        $this->insert("dga_product", [
            'name' => $name,
            'token' => (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 16),
            'category' => $category,
            'arrange' => 0,
            'price' => $price,
            'details' => $details,
            'min' => $min,
            'max' => $max,
            'type' => $type,
            'created_at' => $this->gettime()
        ]);
    }


    public function removeProduct($id)
    {
        $this->remove("dga_product", " `id` = '$id' ");
    }

    public function editProduct($name, $category, $price, $details, $min, $max, $type, $id)
    {
        $this->update("dga_product", array(
            'name' => $name,
            'category' => $category,
            'arrange' => 0,
            'price' => $price,
            'details' => $details,
            'min' => $min,
            'max' => $max,
            'type' => $type,
            'updated_at' => $this->gettime()
        ), " `id` = '$id' ");
    }
}
