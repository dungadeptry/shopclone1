<?php
require_once "../../controller/Connect.php";
require_once "../../models/Settings.php";
require_once "../../models/History.php";


if ((new Settings)->info('api_atm') != NULL) {
    $dataPost = array(
        "access_token" => (new Settings)->info('api_atm'), //token từ hệ thống
        "username" => (new Settings)->info('user_atm'), //Tài khoản bank
        "password" => (new Settings)->info('pass_atm'), //Mật khẩu bank
        "accountNumber" => (new Settings)->info('stk_atm'), //Số tài khoản cần lấy lịch sử
        "bank" => (new Settings)->info('typeBank'), //Ngân hàng cần lấy lsgd
        "day"=> 1 //Ngày lấy lịch sử gần nhất
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apigiare.com/api/getTransHistory",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($dataPost),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "accept: application/json")
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    if ((new Settings)->info('typeBank') == 'VIETCOMBANK') {
        foreach($result['data'] as $data) {
            $des = $data['Description'];
            $amount = $data['Amount'];
            // $tid = explode('\\', $data['refNo'])[0];
            $tid = $data['Reference'];
            $id = (new Func)->parse_order_id($des);
            
            $file = @fopen('HISTORYRECHARGE.txt', 'a');
            if ($id)
            {
                $row = (new Controller)->get_row(" SELECT * FROM `dga_users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if((new Controller)->num_rows(" SELECT * FROM `dga_bank` WHERE `tranId` = '$tid' ") == 0)
                    {
                        if ($file)
                        {
                            $data = "tranId => $tid | comment => $des $id | amount => $amount | username => ".$row['username']." ".PHP_EOL;
                            fwrite($file, $data);
                        }
                        /* GHI LOG BANK AUTO */
                        $create = (new Controller)->insert("dga_bank", array(
                            'tranId' => $tid,
                            'comment' => '1.4.0'.$des,
                            'amount' => $amount,
                            'create_at' => (new Func)->gettime(),
                            'type' => 'VIETCOMBANK',
                            'username' => $row['username']
                        ));
                        if ($create)
                        {
                            $real_amount = $amount * (new Settings)->info('discountBank') / 100;
                            $isCheckMoney = (new Controller)->cong("dga_users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                (new Controller)->cong("dga_users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                (new Controller)->insert('dga_history', [
                                    'username'  => $row['username'],
                                    'Mbefore'   => $row['money'],
                                    'Mchange'   => $real_amount,
                                    'Mafter'    => $row['money'] + $real_amount,
                                    'content'   => 'Nạp tiền tự động ngân hàng (MBBank | '.$tid.')',
                                    'create_at' => (new Func)->gettime()
                                ]);
                            }
                        }
                    }
                }
            }    
        }
    } else if ((new Settings)->info('typeBank') == 'ACB') {
        foreach($result['data'] as $data) {
            $des = $data['description'];
            $amount = $data['amount'];
            $tid = $data['transactionNumber'];
            $id = (new Func)->parse_order_id($des);
            $file = @fopen('HISTORYRECHARGE.txt', 'a');
            if ($id)
            {
                $row = (new Controller)->get_row(" SELECT * FROM `dga_users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if((new Controller)->num_rows(" SELECT * FROM `dga_bank` WHERE `tranId` = '$tid' ") == 0)
                    {
                        if ($file)
                        {
                            $data = "tranId => $tid | comment => $des $id | amount => $amount | username => ".$row['username']." ".PHP_EOL;
                            fwrite($file, $data);
                        }
                        /* GHI LOG BANK AUTO */
                        $create = (new Controller)->insert("dga_bank", array(
                            'tranId' => $tid,
                            'comment' => '1.4.0'.$des,
                            'amount' => $amount,
                            'create_at' => (new Func)->gettime(),
                            'type' => 'ACB',
                            'username' => $row['username']
                        ));
                        if ($create)
                        {
                            $real_amount = $amount * (new Settings)->info('discountBank') / 100;
                            $isCheckMoney = (new Controller)->cong("dga_users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                (new Controller)->cong("dga_users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                (new Controller)->insert('dga_history', [
                                    'username'  => $row['username'],
                                    'Mbefore'   => $row['money'],
                                    'Mchange'   => $real_amount,
                                    'Mafter'    => $row['money'] + $real_amount,
                                    'content'   => 'Nạp tiền tự động ngân hàng (ACB | '.$tid.')',
                                    'create_at' => (new Func)->gettime()
                                ]);
                            }
                        }
                    }
                }
            }    
        }
    } else if ((new Settings)->info('typeBank') == 'TECHCOMBANK') {
        foreach($result['data'] as $data) {
            $partnerId      = $data['partnerId'];               //  SỐ ĐIỆN THOẠI CHUYỂN
            $comment        = $data['comment'];                 // NỘI DUNG CHUYỂN TIỀN
            $tranId         = $data['transId'];                  // MÃ GIAO DỊCH
            $partnerName    = $data['partnerName'];             // TÊN CHỦ VÍ
            $id             = (new Func)->parse_order_id($comment);         // TÁCH NỘI DUNG CHUYỂN TIỀN
            $amount         = $data['amount'];
            $file = @fopen('HISTORYRECHARGE.txt', 'a');
            if ($id)
            {
                $row = (new Controller)->get_row(" SELECT * FROM `dga_users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if((new Controller)->num_rows(" SELECT * FROM `dga_bank` WHERE `tranId` = '$tid' ") == 0)
                    {
                        if ($file)
                        {
                            $data = "tranId => $tid | comment => $des $id | amount => $amount | username => ".$row['username']." ".PHP_EOL;
                            fwrite($file, $data);
                        }
                        /* GHI LOG BANK AUTO */
                        $create = (new Controller)->insert("dga_bank", array(
                            'tranId' => $tranId,
                            'comment' => $comment,
                            'amount' => $amount,
                            'partnerId' => $partnerId,
                            'partnerName' => $partnerName,
                            'create_at' => (new Func)->gettime(),
                            'type' => 'TEACHCOMBANK',
                            'username' => $row['username']
                        ));
                        if ($create)
                        {
                            $real_amount = $amount * (new Settings)->info('discountBank') / 100;
                            $isCheckMoney = (new Controller)->cong("dga_users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                (new Controller)->cong("dga_users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                (new Controller)->insert('dga_history', [
                                    'username'  => $row['username'],
                                    'Mbefore'   => $row['money'],
                                    'Mchange'   => $real_amount,
                                    'Mafter'    => $row['money'] + $real_amount,
                                    'content'   => 'Nạp tiền tự động ngân hàng (TECHCOMBANK | '.$tid.')',
                                    'create_at' => (new Func)->gettime()
                                ]);
                            }
                        }
                    }
                }
            }    
        }
    }
    die();
}
