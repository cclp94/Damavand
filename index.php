<?php
    session_start();
    if (isset($_GET['signout']) && $_GET['signout'] == true) {
        $_SESSION['action'] = 'logout';
    }
    if(isset($_SESSION)){
        if($_SESSION['action'] == 'logout'){
            session_unset();
            session_destroy();
        } elseif($_SESSION['action'] == 'login' && isset($_SESSION['user'])){
            header("Location: ./home.php"); /* Redirect browser */
            exit();
        } elseif(isset($_SESSION['error'])){
            $error = $_SESSION['error'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
       <?php include './templates/head.php';?>
        <title>Damavandoo</title>
    </head>
    <body>
        <div id="main-container" class="container">
            <?php include './templates/header.php';?>
            <?php include './templates/nav-index.php';?>
            <!-- GET CONTENT DEPENDING ON SESSION -->
            <section id="content">
                <?php include './templates/content-index.php';?>
            </section>
            <?php include './templates/footer.php';?>
        </div>
    </body>
</html>
