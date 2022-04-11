<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Users extends Controller
{

    private $token;
    private $username;
    private $password;
    private $fullname;
    private $email;
    private $ip;
    private $money;
    private $total_money;
    private $used_money;
    private $rank;
    private $admin;
    private $UserAgent;
    private $otp;
    private $reason_banned;
    private $created_at;


    public function __construct($username) {
        $this->username = $username;
    }

    function info($data) // LẤY THÔNG TIN USERNAME
    {
        $info = $this->fetch_assoc($this->query("SELECT * FROM `dga_users` WHERE `username` = '" . $this->username . "' "));
        if ($info) {
            return $info[$data];
        } else {
            exit('<script>document.location = "/home";</script>');
        }
    }

    public function saveLogin()
    {
        $this->update("dga_users", array(
            'ip' => $this->myip(),
            'UserAgent' => (new Mobile_Detect)->getUserAgent(),
            'otp' => NULL
        ), " `username` = '".$this->username."' ");
    }

    public function saveBuy($money) {

        $this->update("dga_users", array(
            'money' => $this->info('money') - $money,
            'used_money' => $this->info('money') + $money
        ), " `username` = '".$this->username."' ");

    }



}
