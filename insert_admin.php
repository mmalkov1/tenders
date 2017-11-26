<?php

$db = mysqli_connect('localhost','root','') or die("Невозможно подключиться к БД");
mysqli_select_db ($db,'tender') or die ("Невозможно получить данные");
mysqli_query ($db,"SET NAMES utf8");


$id = $_POST["id"];
$option = $_POST["option"];
$user_login = $_POST["login"];
$user_name = $_POST["user_name"];
$user_mail = $_POST["user_mail"];
$koordinator = $_POST["koordinator"];
$admin = $_POST["administrator"];
$manager = $_POST["manager"];
$tender = $_POST["tender"];
$purchase = $_POST["purchase"];
$tender_got = $_POST["tender_got"];
$user_password = $_POST["user_password"];
$user_password = md5($user_password);

$info = array();
//  $info = "";
switch ($option) {
    case 'edit_user':

        edit_user($id, $user_name, $user_login, $user_password, $user_mail, $admin, $koordinator, $manager, $tender, $purchase,
            $tender_got, $db);
        break;
    case 'delete_user':
        delete_user($id, $db);
        break;
    case 'add_user':

        add_user ($user_name, $user_login, $user_mail, $user_password, $admin, $koordinator, $manager, $tender,
            $purchase, $tender_got,
            $db);
        break;
    default :
        $info["zamena"] = "НЕТ ОПЦИИ";
        echo json_encode("$info");

}
function add_user ($user_name, $user_login, $user_mail, $user_password, $admin, $koordinator, $manager, $tender,
              $purchase, $tender_got,
              $db){

    $query = "INSERT INTO users (user_name, user_login, user_mail, user_password, admin, koordinator, manager, tender,
            purchase, tend_got)
             VALUES 
               ('$user_name', '$user_login', '$user_mail', '$user_password', '$admin','$koordinator', '$manager', '$tender',
              '$purchase', '$tender_got');";


    $res = mysqli_query ($db, $query);
    verification( $res );
    close ($db);


}

function edit_user($id, $user_name, $user_login, $user_password, $user_mail, $admin, $koordinator, $manager, $tender, $purchase,
                   $tender_got, $db){
if ($_POST["user_password"]<>"") {
    $query = "UPDATE users SET user_name = '$user_name',user_login = '$user_login' ,user_password = '$user_password' ,user_mail = '$user_mail', admin = '$admin',koordinator = '$koordinator',
             manager = '$manager', tender = '$tender', purchase = '$purchase',
             tend_got = '$tender_got'
             WHERE id = '$id'";
} else {
    $query = "UPDATE users SET user_name = '$user_name', user_login = '$user_login' ,user_mail = '$user_mail', admin = '$admin', koordinator = '$koordinator',
             manager = '$manager', tender = '$tender', purchase = '$purchase',
             tend_got = '$tender_got'
             WHERE id = '$id'";

}


    $res = mysqli_query($db, $query);
    verification( $res );
    close( $db );


}

function delete_user($id, $db){
    $query = "DELETE FROM users WHERE id = '$id'";
    $res = mysqli_query($db, $query);
    verification( $res );
    close( $db );
}




function verification ($res) {

    if (!res) $info["zamena"] = "ОШИБКА";
    else $info["zamena"] = "ОК";
    echo json_encode($info);


}

function close ($db) {
    mysqli_close($db);

}



?>