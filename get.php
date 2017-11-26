<?php
require_once 'db.php';

// заполнение строк таблицы тендеров 
    
    $name = $_SESSION['logged_user']->user_name;
    $admin = $_SESSION['logged_user']->admin;
    $db = mysqli_connect('localhost', 'root', '') or die("Ошибка подключения к БД");
    mysqli_select_db($db, 'tender') or die ("Не могу подлючится к таблице");
    mysqli_query($db, "SET NAMES utf8") or die ("Кодировка");
    $date_start = $_POST["date_0"];
    $date_end = $_POST["date_2"];
    $filter = $_POST['filter'];
    $option_filter = $_POST['option_filter'];//$_POST['option-filter'];


if ($filter=="filter") {
    if (isset($_SESSION['logged_user'])) {

        if ($admin) {

            $sql = "SELECT * FROM  torgi WHERE $option_filter BETWEEN STR_TO_DATE('$date_start', '%Y-%m-%d') 
          AND STR_TO_DATE('$date_end', '%Y-%m-%d');";

        } else {
            $sql = "SELECT * FROM  torgi WHERE (Manager='" . $name .
                "' OR Tend_send='" . $name .
                "' OR Tend_got='" . $name .
                "' OR Tend_prep='" . $name .
                "' OR Name_purch='" . $name ."') 
                AND ( $option_filter BETWEEN STR_TO_DATE('$date_start', '%Y-%m-%d') AND STR_TO_DATE('$date_end', '%Y-%m-%d'))";
        }
    }
   
    else
        {

        $sql = "SELECT * FROM  torgi WHERE $option_filter BETWEEN STR_TO_DATE('$date_start', '%Y-%m-%d') 
          AND STR_TO_DATE('$date_end', '%Y-%m-%d');";

    }
}        
else {

if (isset($_SESSION['logged_user'])) {

if ($admin) {

    $sql = "SELECT * FROM  torgi";

} else {
    $sql = "SELECT * FROM  torgi WHERE Manager='" . $name .
        "' OR Tend_send='" . $name .
        "' OR Tend_got='" . $name .
        "' OR Tend_prep='" . $name .
        "' OR Name_purch='" . $name . "'";
}

}
else
{

    $sql = "SELECT * FROM  torgi";

}
}

    $result = mysqli_query($db, $sql) or die("Не могу добавить данные в БД");

    $torgi1 = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $torgi1["data"][] = $row;

    }
    mysqli_close($db);
    echo json_encode($torgi1);


?>