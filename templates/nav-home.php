<div class="row">
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Employees</a></li>
            <li><a href="#">Clients</a></li>
            <li><a href="#">My information</a></li>
            <li>Welcome <?php echo $user->userName;?> <a href="./index.php?signout=true">Sign out</a></li>
        </ul>
    </nav>
</div>