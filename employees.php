<?php
    require_once './app/models/user.php';
    require_once './app/models/employee.php';
    session_start();
    if(!isset($_SESSION) || !isset($_SESSION['user'])){
        session_unset();
        session_destroy();
        header("Location: ./index.php"); /* Redirect browser */
        exit();
    }

    $user = unserialize($_SESSION['user']);

?>
<!DOCTYPE html>
<html>
    <head>
       <?php include './templates/head.php';?>
        <title>Damavand</title>
    </head>
    <body>
        <div id="main-container" class="container">
            <?php include './templates/header.php';?>
            <?php include './templates/nav-home.php';?>
            <!-- GET CONTENT DEPENDING ON SESSION -->
            <section id="content">
                <?php include './templates/content-employees.php'; ?>
            </section>
            <?php include './templates/footer.php';?>
        </div>
    </body>
</html>