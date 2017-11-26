<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 04.09.2017
 * Time: 22:14
 */


require 'db.php';

    $id = $_POST["id"];

    $db = mysqli_connect('localhost', 'root', '') or die("������ ����������� � ��");
    mysqli_select_db($db, 'tender') or die ("������ ������ �������");
    mysqli_query($db, "SET NAMES utf8") or die ("������ ������ ���������");




    $sql = "SELECT * FROM  torgi WHERE id ='$id'";
    $result = mysqli_query($db, $sql) or die("������ ������� �� ��");
    $json = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $json[] = $row;

    }
    if ($json[0]['okpo']) {
        $sql1 = "SELECT *, ROUND(CONCAT((sum_itog / sum_purch - 1)*100)) AS percent_itog FROM torgi WHERE okpo=" . $json[0]['okpo'];
        $result1 = mysqli_query($db, $sql1);
        while ($row1 = mysqli_fetch_assoc($result1)) {

            $json[] = $row1;

        }
    }


 echo json_encode($json);


?>