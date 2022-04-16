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


    public function __construct($username)
    {
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
        ), " `username` = '" . $this->username . "' ");
    }

    public function saveBuy($money)
    {

        $this->update("dga_users", array(
            'money' => $this->info('money') - $money,
            'used_money' => $this->info('money') + $money
        ), " `username` = '" . $this->username . "' ");
    }

    public function insertUser($username, $password)
    {

        $this->insert("dga_users", [
            'username' => $username,
            'token' => (new Func)->random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 16),
            'password' => md5($password),
            'money' => 0,
            'total_money' => 0,
            'used_money' => 0,
            'ip' => $this->myip(),
            'rank' => 'member',
            'admin' => 0,
            'UserAgent' => (new Mobile_Detect)->getUserAgent(),
            'created_at' => $this->gettime()
        ]);
    }

    public function saveUser($money, $total_money, $used_money, $level, $status)
    {
        $this->update("dga_users", array(
            'money' => $money,
            'total_money' => $total_money,
            'used_money' => $used_money,
            'rank' => $level,
            'banned' => $status
        ), " `username` = '" . $this->username . "' ");
    }

    public function removeUser($id)
    {
        $this->remove("dga_users", " `id` = '$id' ");
    }

    public function saveRecharge($money)
    {
        $this->update("dga_users", array(
            'money' => $this->info('money') + $money,
            'total_money' => $this->info('money') + $money
        ), " `username` = '" . $this->username . "' ");
    }

    public function savePasssword($password)
    {
        $this->update("dga_users", array(
            'password' => md5($password),
        ), " `username` = '" . $this->username . "' ");
    }
}
