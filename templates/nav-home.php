<div class="row">
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if($user->isAdmin()){?>
                <li><a href="employees.php">Employees</a></li>
                <li><a href="clients.php">Clients</a></li>
                <li><a href="#">Managers</a></li>
            <?php }else{ ?>
                <li><a href="info.php">My information</a></li>
            <?php } ?>
            <li>Welcome <?php echo $user->userName;?> <a href="./index.php?signout=true">Sign out</a></li>
        </ul>
    </nav>
</div>