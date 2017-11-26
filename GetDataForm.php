<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 16.06.2017
 * Time: 23:02

 Файл для заполенения віпадающих списков в форме добавления/редактирования тендера
 * данніе берет из БД.
 */
    require 'db.php';
    $user_id=$_SESSION["logged_user"]->id;
    $db = mysqli_connect("localhost", "root", "", "tender");
    mysqli_query($db, "SET NAMES 'utf8'");
    if (isset($_SESSION['logged_user'])) {   
    $result_admin = mysqli_query($db, "SELECT * FROM users WHERE id=".$user_id);
    while ($row = mysqli_fetch_assoc($result_admin)) {
        if ($row['admin']==1){
            $admin = 1;
        } else {
            $admin = 0;
        }
    }
    }
    $result = mysqli_query($db, "SELECT * FROM users"); 
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['user_name'];
        $id = $row['id'];
        
        if ($row['koordinator']==1) {
          $koordinator .= "<option id = '$id' value='$name'>$name</option>";  
        }
        if ($row['manager']==1) {
          $manager .= "<option id = '$id' value='$name'>$name</option>";  
        }
        if ($row['tender']==1) {
          $tend .= "<option id = '$id' value='$name'>$name</option>";  
        }
        if ($row['tend_got']==1) {
          $tend_got .= "<option id = '$id' value='$name'>$name</option>";  
        }
        if ($row['purchase']==1) {
          $purchase .= "<option id = '$id' value='$name'>$name</option>";  
        }
       
    }

    $result_area = mysqli_query($db, "SELECT * FROM area ");

        while ($row = mysqli_fetch_assoc($result_area)) {
            $name = $row['area_name'];
            $id = $row['area_id'];
            $area .= "<option id = '$id' value='$name'>$name</option>";

        };
    $result_product_group = mysqli_query($db, "SELECT * FROM product_group ");

        while ($row = mysqli_fetch_assoc($result_product_group)) {
            $name = $row['group_name'];
            $id = $row['area_id'];
            $product_group .= "<option id = '$id' value='$name'>$name</option>";

        };    
    $result_organization = mysqli_query($db, "SELECT * FROM organization ");

        while ($row = mysqli_fetch_assoc($result_organization)) {
            $name = $row['org_name'];
            $id = $row['org_id'];
            $organization .= "<option id = '$id' value='$name'>$name</option>";

        };
    

$user_options = array();

if ($_SESSION['logged_user']) {
    $option = R::findOne('option', 'user_id = ?', array($user_id));
    $test = $option->opt0;
    $i = 0;
    while ($i<42) {
        $opt = "opt".$i;
        $checked = $option->$opt;
        if ($checked == "on") {
        $checked = "checked";
        } else {
        $checked = "";    
        }
        //$checked = str_replace("", "false", $checked);
        
       $options .= "<li><input type='checkbox' id='check".$i."' ".$checked."='".$checked."' name='check".$i."' number-checkbox='".$i."'/></li>" ;
        $i++;
    }
    $leftcol = $option->leftcol;
    $rightcol = $option->rightcol;
        
} else {
    $user_id = 14;
    $option = R::findOne('option', 'user_id = ?', array($user_id));
    $test = $option->opt0;
    $i = 0;
    while ($i<42) {
        $opt = "opt".$i;
        $checked = $option->$opt;
        if ($checked == "on") {
        $checked = "checked";
        } else {
        $checked = "";    
        }
        //$checked = str_replace("", "false", $checked);
        
       $options .= "<li><input type='checkbox' id='check".$i."' ".$checked."='".$checked."' number-checkbox='".$i."'/></li>" ;
        $i++;
    }
    $leftcol = $option->leftcol;
    $rightcol = $option->rightcol;

}    

?>