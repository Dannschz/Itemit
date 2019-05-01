<?php

require 'database.php';

class User 
{
    public $name;
    public $email;
    public $auth;
    public $message;

    function __construct($name, $email, $auth, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->auth = $auth;
        $this->message = $message;
    }
}

if(!empty($_POST['email'] && !empty($_POST['password']))) {
    $email = $_POST['email'];
    $query = "SELECT user_name, email, password FROM users WHERE email = '$email'";

    $user = new User('', $email, false, '');

    if($records = $mysqli->query($query)) {
        $results = $records->fetch_assoc();

        if(count($results) > 0 && $email == $results['email'] && password_verify($_POST['password'], $results['password'])) {
            $user->auth = true;
            $user->name = $results['user_name'];
            $user->message = 'Bienvenido ' . $user->name;
        } else {
            $user->message = 'Este usuario no existe';
        }
    }
    echo json_encode($user);
}

?>