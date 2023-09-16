<?php

$servername = "localhost";
$username = "phpmyadmin";
$password = "0122";
$dbname = "juncathytest";

$sqlconn = mysqli_connect($servername,$username, $password,$dbname);

if(!$sqlconn) {
    die("Connection Failed". mysqli_connect_error());

}
?>