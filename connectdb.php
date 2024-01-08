<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "juncathytest";

$sqlconn = mysqli_connect($servername,$username, $password,$dbname);

if(!$sqlconn) {
    die("Connection Failed". mysqli_connect_error());

}
?>