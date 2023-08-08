<?php

$srv = 'localhost';
$usr = 'root';
$pass = '';
$db = 'cars';
$conn = mysqli_connect($srv, $usr, $pass, $db);

if(!$conn)
{
    die('Błąd połączenia'.mysqli_connect_error());
}

?>