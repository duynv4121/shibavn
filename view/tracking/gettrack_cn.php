<?php

	$billketnoi = $_GET['billketnoi'];
	$hangketnoi = $_GET['hangketnoi'];
	
    //参数设置
    $key = 'hrOPQESJ8459';                        //客户授权key
    $customer = '5261D3862591DBBB377735C0022104AF';                   //查询公司编号
    $param = array (
        'com' => $hangketnoi,          //快递公司编码
        'num' => $billketnoi,   //快递单号
        'phone' => '',                //手机号
        'from' => '',                 //出发地城市
        'to' => '',                   //目的地城市
        'resultv2' => '1'             //开启行政区域解析
    );

    //请求参数
    $post_data = array();
    $post_data["customer"] = $customer;
    $post_data["param"] = json_encode($param);
    $sign = md5($post_data["param"].$key.$post_data["customer"]);
    $post_data["sign"] = strtoupper($sign);

    $url = 'http://poll.kuaidi100.com/poll/query.do';    //实时查询请求地址

    $params = "";
    foreach ($post_data as $k=>$v) {
        $params .= "$k=".urlencode($v)."&";              //默认UTF-8编码格式
    }
    $post_data = substr($params, 0, -1);

    //发送post请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    $result = curl_exec($ch);
    $data = json_decode($result);

echo var_dump($data);


?>