<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /LoginPHP");
}

require 'database.php';

if(!empty($_POST['email'] && !empty($_POST['password']))) {
    $email = $_POST['email'];
    $query = "SELECT id, email, password FROM users WHERE email = '$email'";
    $records = $mysql->query($query);
    $results = $records->fetch_array(MYSQLI_ASSOC);

    $message = '';

    if(count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /LoginPHP");
    } else {
        $message = "Sorry, those credentials don't match";
    }
}

?>

    <?php require '../partials/head.php' ?>
    
    <main class="login-page">
        <?php if(!empty($message)) { ?>
            <style> .user_create {display: flex; justify-content: center;} </style>
            <style> p {width; 350px; padding: 10px; border-radius: 3px; color: #fff; background: #192; font-size: 1.2em;} </style>
            <div class="user_create"><p><?= $message ?></p></div>
        
        <?php } ?>

        <div class="form-container">
            <h1>Bienvenido</h1>
            <h4>¡Estamos contentos de verte!</h4>
            <form id="loginForm" >
                <label>Correo Electrónico</label>
                <input type="text" name="email" required>
                <label>Contraseña</label>
                <input type="password" name="password" required>
                <div class="submit"><button type="submit">Inicia Sesión</button></div>
                <p class="r">¿Necesitas una cuenta? <a href="signup.php"> Registrate</a></p>
            </form>
        </div>
    </main>
</body>
</html>