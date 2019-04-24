<?php

$server = 'localhost';
$user = 'itemit';
$password = 'itemit';
$database = 'itemit_users';

$mysqli = new mysqli($server, $user, $password, $database);

if($mysqli->connect_error) {
    echo "Connect Failed " . $mysqli->connect_error;
    die();
}

?>