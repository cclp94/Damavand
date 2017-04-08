<div class="row">
    <div id="main-text" class="col-md-push-2 col-md-8 text-center">
        <h1 class="text-center">Register Now</h1>
            <form method="post" action="./app/register.php">
                <div class="form-group">
                    <label for="permission" class="col-sm-2 control-label text-center">Permissions</label>
                    <div class="col-sm-10">
                        <input type="radio" name="permission" value="client"> Client <br>
                        <input type="radio" name="permission" value="manager"> Manager <br>
                    </div>
                </div>
                <div class="form-group">
                        <label for="username" class="col-sm-2 control-label text-center">Username</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="username" placeholder="User" required/></br>
                        </div>
                </div>
                <div class="form-group">
                        <label for="password" class="col-sm-2 control-label text-center">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name="password" placeholder="Password" required/></br>
                        </div>
                </div>
                <div class="form-group">
                        <label for="passwordConfirm" class="col-sm-2 control-label text-center">Confirm Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name="passwordConfirm" placeholder="Confirm Password" required/></br>
                        </div>
                </div>
                <!--
                <div class="form-group">
                        <label for="email" class="col-sm-2 control-label text-center">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="email" placeholder="Email" required/></br>
                        </div>
                </div>
                -->
                <input  class="btn btn-primary btn-lg center-block" type="submit" value="Register"/>
            </form>
    </div>
</div>