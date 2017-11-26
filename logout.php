<?php
require 'db.php';
setcookie("id", "", time()-144000);
unset($_SESSION['logged_user']);
header('location: /datatable.php');

?>