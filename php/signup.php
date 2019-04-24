<?php 

require 'database.php'; 

session_start();

$errors = array();

if(!empty($_POST)) 
{
    $email = $mysqli->real_escape_string($_POST['email']);
    $user_name = $mysqli->real_escape_string($_POST['user_name']);
    $password = $mysqli->real_escape_string($_POST['password']);

    /* Verificar que todos los campos tengan */
    if(empty($email) || empty($user_name) || empty($password)) {
        $errors[] = "Todos los campos deben ser llenados";
    }
    /* Validar correo electronico */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = " - El email introducido no es valido";
    }
    
}
else {
    
}



?>
    <?php require '../partials/head.php' ?>

    <main class="signup-page">
        <div class="form-container">
            <h1>Crear una Cuenta</h1>
            <form class="form-signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <label>Correo Electrónico <?php if(isset($errors['email'])) {echo '<span class="err-list">'. $errors['email'] .'</span>';} ?> </label>
                <input type="text" name="email" value="" required>
                <label>Nombre de usuario</label>
                <input type="text" name="user_name" value="" required>
                <label>Contraseña</label>
                <input type="password" name="password" value="">
                <div class="submit"><input type="submit" value="Registrate"></div>
                <a href="login.php">¿Ya tienes una cuenta?</a>
                <div class="errors">
                    <?php 
                    if(count($errors) > 0) {
                        echo '<ul>';
                        for ($i = 0; $i < count($errors); $i++) {
                            echo '<li class="err-list">' . $errors[$i] . "</li>";
                        } echo "</ul>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </main>
    <script src="../php/js/signup.js"></script>
</body>
</html>