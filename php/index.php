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

<?php require '../partials/head.php' ?>

    <main class="main-page">
        <?php require '../partials/header.php' ?>

        <section class="section-1">
            <h1 class="title-h">Nada que hacer?</h1>
            <p class="sub-title-h">Registra y almacena Articulos de todo tipo, de esta forma jamás olvidarás aquello que tanto deseas</p>
            <div class="box-1-c">
                <div class="box-1">
                    Image Here
                </div>
            </div>
        </section>
        <section class="section-2">
            <div class="box-2-content">
                <div class="box-2">
                    Any content here
                </div>
            </div>
        </section>

        <?php require '../partials/footer.php' ?>
    </main>
    
    <script src="../app/index.js"></script>
</body>
</html>