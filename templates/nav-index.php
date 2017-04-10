<div class="row">
    <nav class="nav navbar-nav">
        <ul class="navbar-nav">
            <li><a href="index.php">Home</a></li>
            <!--<li><a href="#">Services</a></li>-->
            <li><a href="./register.php">Register</a></li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li><?php echo ($user ? 'Welcome, '.$user->userName . '<a href="#">Sign out</a>': '');?></li>
        </ul>
    </nav>
</div>