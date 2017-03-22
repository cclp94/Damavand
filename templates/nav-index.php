<div class="row">
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="./register.php">Register</a></li>
            <li><?php echo ($user ? 'Welcome, '.$user->userName . '<a href="#">Sign out</a>': '<a href="#">Login</a>');?></li>
        </ul>
    </nav>
</div>