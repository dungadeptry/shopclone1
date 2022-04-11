<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Settings extends Controller {

    function info($data) // LẤY THÔNG TIN WEB
    {
        $info =  $this->fetch_assoc($this->query("SELECT * FROM `dga_setting`"));
        return $info[$data];
    }

}