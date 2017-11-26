<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 08.07.2017
 * Time: 11:17
 */
require 'db.php';

    $user_id=$_POST['userId'];


    if ($_SESSION['logged_user']) {
        $option = R::findOne('option', 'user_id = ?', array($user_id));

        if ($option) {
            for ($i=0;$i<=42;$i++) {
                $opt = "opt".$i;
                $option->$opt = $_POST['check'.$i];
            }
            $option->leftcol = $_POST['left'];
            $option->rightcol = $_POST['right'];
            R::store($option);
            echo "Настройки сохранены";
        } else {
            $option = R::dispense('option');
            $option->user_id = $user_id;
            for ($i=0;$i<=42;$i++) {
                $opt = "opt".$i;
                $option->$opt = $_POST['check'.$i];
            }
            $option->leftcol = $_POST['left'];
            $option->rightcol = $_POST['right'];
            R::store($option);
            echo "Настройки созданы и сохранены";
        }
    } else {

        echo "Настройки сохраняются только, если вы залогинены. 
Пожалуйста, Войдите под своим логином или зарегистрируйтесь";
    }

        ?>

