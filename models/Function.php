<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class Func extends Controller
{

    public function xss($data)
    {
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

        return str_replace(array('<', "'", '>', '?', "\\", '--', 'eval(', '<php'), array('', '', '', '', '', '', '', '', ''), htmlspecialchars(addslashes(strip_tags($data))));
    }

    public function responseForm1($msg, $status)
    {
        $data['message'] = $msg;
        $data['status']  = $status;
        die(json_encode($data));
    }

    public function responseForm2($msg, $status, $code)
    {
        $data['message'] = $msg;
        $data['code']  = $code;
        $data['status']  = $status;
        die(json_encode($data));
    }

    function calDate($type, $day, $time)
    {
        $nowdate = time();
        if ($type == '-') {
            $newdate = strtotime('- ' . $day . ' ' . $time . '', $nowdate);
        }
        return $newdate;
    }

    function calDateDay($type, $date)
    {
        $nowdate = time();
        if ($type == '-') {
            $newdate = strtotime('- ' . $date . ' day', $nowdate);
        }
        return date('Y-m-d', $newdate);
    }

    function calTotalRecharge($day)
    {
        $totalBank = 0;
        $totalCard = 0;
        foreach ($this->get_list("SELECT * FROM `dga_bank` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ") as $row) {
            $date = strtotime($row['created_at']);
            if (date('d', $date) == $day) {
                $totalBank = $totalBank + $row['amount'];
            }
        }
        foreach ($this->get_list("SELECT * FROM `dga_card` WHERE `status` = '0' AND WEEK(created_at, 1) = WEEK(CURDATE(), 1) ") as $row) {
            $date = strtotime($row['created_at']);
            if (date('d', $date) == $day) {
                $totalCard = $totalCard + $row['amount'];
            }
        }
        $total = ($totalBank + $totalCard) / 1000;
        return $total;
    }

    function calTotalSpending($day)
    {
        $totalBank = 0;
        $totalCard = 0;
        foreach ($this->get_list("SELECT * FROM `dga_orders` WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) ") as $row) {
            $date = strtotime($row['created_at']);
            if (date('d', $date) == $day) {
                $totalBank = $totalBank + $row['price'];
            }
        }
        $total = ($totalBank + $totalCard) / 1000;
        return $total;
    }

    function middleware($type)
    {

        if ($type == 'guest') {
        } else if ($type == 'auth') {
            if (!isset($_SESSION['username'])) {
                header('Location: /login');
            } else {
                // return $_SESSION['username'];
            }
        } else if ($type == 'isAdmin') {
            $user = new Users($_SESSION['username']);
            if (!isset($_SESSION['username'])) {
                header('Location: /login');
            } else if ($user->info('admin') != 1) {
                if (!isset($_SESSION['username'])) {
                    header('Location: /login');
                }
            }
        } else if ($type == 'isAdminReq') {
            $user = new Users($_SESSION['username']);
            if (!isset($_SESSION['username'])) {
                return false;
            } else if ($user->info('admin') != 1) {
                if (!isset($_SESSION['username'])) {
                    return false;
                }
            } else {
                return true;
            }
        } else if ($type == 'isUserReq') {
            $user = new Users($_SESSION['username']);
            if (!isset($_SESSION['username'])) {
                return false;
            } else {
                return true;
            }
        }
    }

    function active($link, $css1, $css2)
    {
        if ($_SERVER['REQUEST_URI'] == $link) {
            return $css1;
        } else {
            return $css2;
        }
    }

    function random($string, $int)
    {
        $chars = $string;
        $data = substr(str_shuffle($chars), 0, $int);
        return $data;
    }

    function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        
        curl_close($ch);
        return $data;
    }

    function checkLiveClone($uid)
    {
        $json = json_decode($this->curlGet("https://graph2.facebook.com/v3.3/" . $uid . "/picture?redirect=0"), true);
        if (!empty($json['data'])) {
            if (empty($json['data']['height']) && empty($json['data']['width'])) {
                return 'DIE';
            } else {
                return 'LIVE';
            }
        } else {
            return 'DIE';
        }
    }

    function imgBank($type) {
        if ($type == 'VIETCOMBANK') {
            return '/public/img/vietcombank-logo.png';
        } else if ($type == 'ACB') {
            return '/public/img/acb-logo.png';
        }
    }
}
