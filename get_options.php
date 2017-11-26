<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 22.07.2017
 * Time: 11:53
 */
require 'db.php';
//восстановление сохренных опций пользователей (отображение столбцов)

$user_id=$_SESSION["logged_user"]->id;

$user_options = array();

if ($_SESSION['logged_user']) {
   $option = R::findOne('option', 'user_id = ?', array($user_id));
   

    $test = $option->opt0;
    $i = 0;
    while ($i<42) {
        $opt = "opt".$i;
        $user_options[] = $option->$opt;
        $i++;
    }
    $user_options[] = $option->leftcol;
    $user_options[] = $option->rightcol;
        echo json_encode($user_options);
        echo json_encode($option);
}
else {

    for ($i=0;$i<42;$i++) {
        $user_options[] = "on";

    }
    $user_options[0]="";
    $user_options[2]="";
    $user_options[7]="";
    $user_options[9]="";
    $user_options[10]="";
    $user_options[11]="";
    $user_options[13]="";
    $user_options[14]="";
    $user_options[15]="";
    $user_options[16]="";
    $user_options[17]="";
    $user_options[18]="";
    $user_options[19]="";
    $user_options[20]="";
    $user_options[21]="";
    $user_options[22]="";
    $user_options[23]="";
    $user_options[24]="";
    $user_options[25]="";
    $user_options[26]="";
    $user_options[27]="";
    $user_options[28]="";
    $user_options[29]="";
    $user_options[30]="";
    $user_options[31]="";
    $user_options[32]="";
    $user_options[33]="";
    $user_options[34]="";
    $user_options[35]="";
    $user_options[36]="";
    //$user_options[2]="";

    echo json_encode($user_options);
}
?>