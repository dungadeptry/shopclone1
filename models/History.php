<?php

/**
 * WEB BÁN CLONE 
 * @version 1.0
 * @author DUNGA
 * Vui lòng tôn trọng tác giả nhé! xin cảm ơn!
 */


class History extends Controller
{

    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function save($Mbefore, $Mchange, $Mafter, $content) 
    {
        $this->insert('dga_history', [
            'username' => $this->username,
            'Mbefore' => $Mbefore,
            'Mchange' => $Mchange,
            'Mafter' => $Mafter,
            'content' => $content,
            'created_at' => $this->gettime()
        ]);
    }



}
