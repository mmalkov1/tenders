<?php
require 'db.php';

$data = $_POST;
if(isset($data['do_signup']))
{
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
        header('location: /login.php');
    }
    else{
    echo '<div style="color:red; text-align: center"><h2>'.array_shift($errors).'<h2></div><hr>';

}
}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>Регистрация</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">

</head>
    <div id="login">
      <form name='form-login' action="/signup.php" method="post">
        <span class="fontawesome-user"></span>
          <input type="text" id="user" name="user" placeholder="Введите логин" value="<?php echo @$data['user']?>">
          <span class="fontawesome-envelope"></span>
          <input type="text" id="u_name" name="u_name" placeholder="Введите Ф.И.О." value="<?php echo @$data['u_name']?>">
          <span class="fontawesome-envelope"></span>
          <input type="text" id="email" name="email" placeholder="Введите e-mail" value="<?php echo @$data['email']?>">
          <span class="fontawesome-lock"></span>
          <input type="password" id="pass" name="pass" placeholder="Введите свой пароль" >
          <span class="fontawesome-lock"></span>
          <input type="password" id="pass2" name="pass2" placeholder="Введите пароль еще раз">
        <input type="submit" name ="do_signup" value="Регистрация">
      </form>
    </div>
  
</body>
</html>
