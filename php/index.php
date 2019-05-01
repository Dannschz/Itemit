<?php

session_start();

require 'database.php';


if(isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $query = "SELECT id, email, password FROM users WHERE id='$id'";
    $records = $mysql->query($query);
    $results = $records->fetch_array(MYSQLI_ASSOC);

    $users = null;

    if(count($results) > 0) {
        $users = $results;
    }
}

?>