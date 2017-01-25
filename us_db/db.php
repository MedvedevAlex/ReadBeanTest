<?php
require_once('ReadBeanPHP/rb.php');
//launch MariaDB
R::setup( 'mysql:host=localhost;dbname=users',
        'root', NULL );
session_start();
?>