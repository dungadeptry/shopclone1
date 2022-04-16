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
        foreach ($this->get_list("SELECT * FROM `dga_bank` ") as $row) {
            $date = strtotime($row['created_at']);
            if (date('d', $date) == $day) {
                $totalBank = $totalBank + $row['amount'];
            }
        }
        foreach ($this->get_list("SELECT * FROM `dga_card` ") as $row) {
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
        $total = 0;
        foreach ($this->get_list("SELECT * FROM `dga_orders` ") as $row) {
            $date = strtotime($row['created_at']);
            if (date('d', $date) == $day) {
                $total = $total + $row['price'];
            }
        }
        $total = $total / 1000;
        return $total;
    }

    function middleware($type)
    {

        if ($type == 'guest') {
            if (isset($_SESSION['username'])) {
                header('Location: /home');
            }
        } else if ($type == 'auth') {
            if (!isset($_SESSION['username'])) {
                header('Location: /login');
            } else {
                // header('Location: /home');
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

    function imgBank($type)
    {
        if ($type == 'VIETCOMBANK') {
            return '/public/img/vietcombank-logo.png';
        } else if ($type == 'ACB') {
            return '/public/img/acb-logo.png';
        }
    }

    function timeAgo($time_ago)
    {
        $time_ago   = date("Y-m-d H:i:s", $time_ago);
        $time_ago   = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed;
        $minutes    = round($time_elapsed / 60);
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400);
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640);
        $years      = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "$seconds giây trước";
        }
        //Minutes
        else if ($minutes <= 60) {
            return "$minutes phút trước";
        }
        //Hours
        else if ($hours <= 24) {
            return "$hours tiếng trước";
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "Hôm qua";
            } else {
                return "$days ngày trước";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            return "$weeks tuần trước";
        }
        //Months
        else if ($months <= 12) {
            return "$months tháng trước";
        }
        //Years
        else {
            return "$years năm trước";
        }
    }

    function browser_name($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

        return 'Other';
    }
}
