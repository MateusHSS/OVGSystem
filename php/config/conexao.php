<?php

$banco= "ovg2_teste";
$host= "localhost";
$user= "root";
$senha= "";

$connect = mysqli_connect($host, $user, $senha, $banco) or die("Error " . mysqli_error($connect));

mysqli_set_charset($connect,"utf8");

?>