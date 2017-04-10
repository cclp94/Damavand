
<div class="row">
    <div id="main-text" class="col-md-8">
        <h1>Damavand Contruction</h1>
        <div>
            <img src="./img/construction.jpg" class="fit"/>
            <p>
                Damavand is a modern, forward-thinking construction company. We aim to provide the highest level of service through synergy, business sense,
                and old-fashioned hard work. Customer satisfaction is own number-one priority. If you do busniness with us, we guarantee that you will
                be second to none. Thirdly, we appreciate you.
            </p>
            <p>
                <b>Damavand</b> - come build with us.
            </p>
        </div>
    </div>
    <div class="col-md-4">
        <div id="login-form">
            <h3>Login</h3>
            <form method="post" action="./app/login.php">
                <input class="form-control" type="text" name="username" placeholder="User" required/></br>
                <input class="form-control" type="password" name="password" placeholder="Password" required/></br>
                <input  class="form-control" type="submit" value="Login"/>
            </form>
            <span style="color: red;"><?echo $error;?></span>
        </div>
    </div>
</div>