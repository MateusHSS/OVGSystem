<?php

$banco= "ovg_system";
$host= "localhost";
$user= "root";
$senha= "";

$connect = new mysqli($host, $user, $senha, $banco) or die("Error " . mysqli_error($connect));

mysqli_set_charset($connect,"utf8");

?>