<?php
require_once 'db.php';

// заполнение строк таблицы тендеров 

    $name = $_SESSION['logged_user']->user_name;
    $admin = $_SESSION['logged_user']->admin;
    $db = mysqli_connect('localhost', 'root', '') or die("������ ����������� � ��");
    mysqli_select_db($db, 'tender') or die ("������ ������ �������");
    mysqli_query($db, "SET NAMES utf8") or die ("������ ������ ���������");

if (isset($_SESSION['logged_user'])) {

if ($admin) {

    $sql = "SELECT * FROM  torgi WHERE date_add BETWEEN STR_TO_DATE('2030-10-19 00:00:00', '%Y-%m-%d %H:%i:%s') 
  AND STR_TO_DATE('2030-10-31 23:59:59', '%Y-%m-%d %H:%i:%s');";

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

    $result = mysqli_query($db, $sql) or die("������ ������� �� ��");

    $torgi1 = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $torgi1["data"][] = $row;

    }
    mysqli_close($db);
    echo json_encode($torgi1);


?>