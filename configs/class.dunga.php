<?php

class DUNGA
{
    public  $version  = "1.0";
    private $connect;
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "shopclone1";


    private function connect()
    {
        if (!$this->connect) {
            session_start();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            error_reporting();
            $this->connect = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die("Can't connect to database'");
            mysqli_query($this->connect, "SET NAMES 'UTF8'");
        }
    }

    public function query($sql)
    {
        $this->connect();
        return mysqli_query($this->connect, $sql);
    }

    protected function fetch_assoc($sql)
    {
        $this->connect();
        return mysqli_fetch_assoc($sql);
    }

    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . mysqli_real_escape_string($this->connect, $value) . "'";
        }
        $sql = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';

        return mysqli_query($this->connect, $sql);
    }

    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" . mysqli_real_escape_string($this->connect, $value) . "',";
        }
        $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;
        return mysqli_query($this->connect, $sql);
    }

    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" . mysqli_real_escape_string($this->connect, $value) . "',";
        }
        $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where . ' LIMIT ' . $value1;
        return mysqli_query($this->connect, $sql);
    }

    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->connect, $sql);
    }

    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connect, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }

    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connect, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }

    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connect, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        } else {
            return 0;
        }
        return false;
    }


    function login($username, $password)
    {
        $this->connect();
        $_SESSION['username'] = $username;
    }


    function insertHistory($username, $Mbefore, $Mchange, $Mafter, $content)
    {
        $this->connect();
        $this->insert('dga_history', [
            'username' => $username,
            'Mbefore' => $Mbefore,
            'Mchange' => $Mchange,
            'Mafter' => $Mafter,
            'content' => $content,
            'created_at' => $this->gettime()
        ]);
    }

    public function editUser($data)
    {

    }

    public function msgSwal($message, $href, $status)
    {
        return "swal(" . $message . ", " . $status . ")";
    }

    public function gettime()
    {
        return date('Y-m-d H:i:s', time());
    }

    public function myip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }


    public function getToken()
    {
        $this->connect();
        if (isset($_SESSION['token'])) {
            return $_SESSION['token'];
        } else {
            exit('<script>document.location = "/login";</script>');
        }
    }

    public function responseForm1($msg, $status)
    {
        $this->connect();
        $data['message'] = $msg;
        $data['status']  = $status;
        die(json_encode($data));
    }

    function xss($data)
    {
        $this->connect();
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

    function check($type)
    {
        if ($type == 'guest') {
            if (isset($_SESSION['username'])) {
                exit('<script>document.location = "/home";</script>');
            }
        }
    }
}
$DUNGA = new DUNGA;
