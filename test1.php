<?php 
require 'db.php';


$user_id=$_SESSION["logged_user"]->id;

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
        
       $options .= "<li><input type='checkbox' id='check".$i."' ".$checked."/><label>Номер п/п</label></li>" ;
        $i++;
    }
    $user_options[] = $option->leftcol;
    $user_options[] = $option->rightcol;
        
}
echo $options;
?>
