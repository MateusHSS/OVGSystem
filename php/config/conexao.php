<?php

$banco= "ongceu28_ovgsystem";
$host= "localhost";
$user= "root";
$senha= "";

$connect = mysqli_connect($host, $user, $senha, $banco) or die("Error " . mysqli_error($connect));

mysqli_set_charset($connect,"utf8");

?>