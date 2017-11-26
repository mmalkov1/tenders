<?php
require 'db.php';

$option = R::findOne('users', 'user_name = ?', array($_POST['koordinator']));
$user = 'malkov10@gmail.com';
$password = '1qazXSW@';
$message_id = '832401';
$send_email_url = 'https://esputnik.com/api/v1/message/'.$message_id.'/smartsend';

$json_value = new stdClass();
$jsonParam = json_encode(array("number"=>$_POST['id'] ,
    "name"=>$_POST['koordinator'],
    "zakazchik"=>$_POST['name'],
    "date_end"=>$_POST['date_end'],
    "manager"=>$_POST['manager'],
    "conditions"=>$_POST['cond_koord'],
    "link"=>$_POST['link'],
    "sum"=>$_POST['sum_zakaz'],
    "tovar"=>$_POST['redmet_torgov'],
    "dop"=>$_POST['organization']
    ));
$json_value->recipients = array(array('email'=>$option->user_mail, 'jsonParam'=>$jsonParam));



function request ($url , $user, $password, $postdata)
{

    $ch = curl_init($url);
   // curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
    //curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0');
   // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



    $html = curl_exec($ch);
    curl_close( $ch );
    echo $html;

}


$html = request($send_email_url, $user, $password, $json_value);

echo $html;


?>