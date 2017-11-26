<?php

require "lib/rb.php";
R::setup( 'mysql:host=localhost;dbname=tender',
    'root', '' ); //for both mysql or mariaDB
R::freeze( true );
session_start();
?>