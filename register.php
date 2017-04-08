<!DOCTYPE html>
<html>
    <head>
       <?php include './templates/head.php';?>
        <title>Damavand</title>
    </head>
    <body>
        <div id="main-container" class="container">
            <?php include './templates/header.php';?>
            <?php include './templates/nav-index.php';?>
            <!-- GET CONTENT DEPENDING ON SESSION -->
            <section id="content">
                <?php include './templates/content-register.php';?>
            </section>
            <?php include './templates/footer.php';?>
        </div>
    </body>
</html>
