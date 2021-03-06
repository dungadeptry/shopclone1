<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Category extends Controller
{

    public function arrange($id, $stt) 
    {
        $this->update("dga_category", array(
            'arrange' => $stt,
        ), " `id` = '$id' ");
    }

    public function insertFather($name, $images) {
        $this->insert("dga_category", [
            'name' => $name,
            'token' => (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 16),
            'images' => $images,
            'arrange' => 0,
            'created_at' => $this->gettime()
        ]);
    }

    public function insertChild($name, $images, $category) {
        $this->insert("dga_category", [
            'name' => $name,
            'token' => (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 16),
            'images' => $images,
            'arrange' => 0,
            'category' => $category,
            'created_at' => $this->gettime()
        ]);
    }

    public function editCategory($category, $thumb, $name, $id) {
        if ($thumb != null || $thumb != '') {
            $this->update("dga_category", array(
                'category' => $category,
                'name' => $name
            ), " `id` = '$id' ");
        } else {
            $this->update("dga_category", array(
                'category' => $category,
                'name' => $name,
                'thumb' => $thumb
            ), " `id` = '$id' ");
        }
    }

    public function removeCategory($id) {
        $this->remove("dga_category", " `id` = '$id' ");
    }
}
