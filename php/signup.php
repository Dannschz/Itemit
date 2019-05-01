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


if(!empty($_POST)) 
{
    $email = $mysqli->real_escape_string($_POST['email']);
    $user_name = $mysqli->real_escape_string($_POST['user_name']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $pasw_hash = password_hash($password, PASSWORD_BCRYPT);

    /* Verificar que todos los campos se manden con contenido */
    if(empty($email) || empty($user_name) || empty($password)) {
        $errors[] = "Todos los campos deben ser llenados";
        die("Todos los campos deben ser llenados");
    }
    /* Validar correo electronico */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = " - El email introducido no es valido";
       die("Email incorrecto");
    }

    $user_object = new User($user_name, $email, false, '');

    try {
        $result = $mysqli->query("SELECT user_name, email FROM users WHERE user_name = '$user_name' OR email = '$email'");
        $row = $result->fetch_assoc();
    } catch (\Throwable $th) {
        throw $th;
    }

    if($row > 0)
    {
        $user_object->auth = true;
        $user_object->message = 'Este usuario ya existe';
    } 
    else if($mysqli->query("INSERT INTO users (user_name, email, password) VALUES ('$user_name', '$email', '$pasw_hash')"))
    {
        $user_object->message = 'Usuario creado Satisfactoriamente';
    }
    else 
    {
        $user_object->message = 'error al crear usuario';
    }

    $mysqli->close();

    echo json_encode($user_object);
}
else {
    $user_null = new User('', '', false, 'No hay datos');
    echo json_encode($user_null);
}


?>