<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Bank extends Controller
{


    public function insertBankAdmin($username, $amount, $tranId, $type) 
    {
        $this->insert('dga_bank', [
            'username' => $username,
            'tranId' => $tranId,
            'type' => $type,
            'amount' => $amount,
            'comment' => (new Settings)->info('ndRecharge').$this->get_row("SELECT * FROM `dga_users` WHERE `username` = '$username' ")['id'],
            'created_at' => $this->gettime()
        ]);
    }


}