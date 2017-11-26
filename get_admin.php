<?php
$db = mysqli_connect('localhost','root','') or die("������ ����������� � ��");
mysqli_select_db ($db,'tender') or die ("������ ������ �������");
mysqli_query ($db,"SET NAMES utf8") or die ("������ ������ ���������");

$sql = "SELECT * FROM  users  ORDER BY id DESC";


$result = mysqli_query ($db, $sql) or die("������ ������� �� ��");

$torgi1 = array ();

while ($row = mysqli_fetch_assoc($result)) {


    $torgi1["data"][] = $row;


}

echo json_encode($torgi1);


?>