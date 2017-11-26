<?php
require 'db.php';

$data = $_POST;

if($data['do_login']=="login") {
    $errors = array();
    $user = R::findOne('users', 'user_login = ?',array($data['user']));
if ($user){
    //логин существует

    $pass = $user->user_password;
    if (md5($data['pass']) == $pass) {

        //Залогиниваем
        $_SESSION['logged_user'] = $user;

        setcookie("id", $_SESSION['logged_user']->id, time()+604800);
       
        echo json_encode("Вы авторизованы");

    }
    else {

        $errors[] = 'Пароль неверный';
    }
}
else {
    $errors[] = 'Пользователь не найден';

}
    if (!empty($errors)){

        echo json_encode(array_shift($errors));
    }


} elseif ($data['do_login']=="signup") {
     $errors = array();

    if(trim($data['user'])==''){
         $errors[]='Введите логин';
    };
    if($data['u_name']==''){
        $errors[]='Заполните Ф.И.О.';
    };
    if(trim($data['email'])==''){
        $errors[]='Введите e-mail';
    };
    if($data['pass']==''){
        $errors[]='Введите пароль';
    };
    if($data['pass2']!= $data['pass']){
        $errors[]='Повторный пароль введен неверно';
    };
    if(R::count('users', "user_login = ?", array($data['user'])) > 0){
        $errors[] = 'Пользователь с таким логином существует';
    };
    if(R::count('users', "user_mail = ?", array($data['email'])) > 0){
        $errors[] = 'Пользователь с таким Email существует';
    };

    if (empty($errors)){

        //Регистрируем
        $user = R::dispense('users');
        $user->user_login = $data['user'];
        $user->user_name = $data['u_name'];
        $user->user_mail = $data['email'];
        $user->user_password = md5($data['pass']);
        R::store($user);
        $option = R::dispense('option');
        $option->user_id = $user->id;
        for ($i=0;$i<=42;$i++) {
            $opt = "opt".$i;
            $option->$opt = "on";
        };
        $option->opt4 = "";
        $option->opt7 = "";
        $option->opt8 = "";
        $option->opt10 = "";
        $option->opt11 = "";
        $option->opt13 = "";
        $option->opt14 = "";
        $option->opt15 = "";
        $option->opt23 = "";
        $option->opt18 = "";
        $option->opt19 = "";
        $option->opt20 = "";
        $option->opt24 = "";
        $option->opt25 = "";
        $option->opt26 = "";
        $option->opt36 = "";
        $option->opt39 = "";
        $option->opt40 = "";
        R::store($option);
        $_SESSION['logged_user'] = $user;
        setcookie("id", $_SESSION['logged_user']->id, time()+604800);
        echo json_encode("Зарегистрирован");       
    }
    else{
    echo json_encode(array_shift($errors));
    }
} else {
    echo json_encode("Ошибка с передачей данных");
}

?>
