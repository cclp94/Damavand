
<div class="row">
    <div id="main-text" class="col-md-8">
        <h1>Damavand Contruction</h1>
        <div>
            <img src="./img/construction.jpg" class="fit"/>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis magna massa.
                Mauris justo erat, placerat eget fringilla eu, facilisis sed justo. Maecenas lobortis
                est eget leo vestibulum facilisis. Donec in accumsan urna. In eu quam tincidunt, sodales
                erat ut, pellentesque ex. Duis ac finibus velit, in gravida enim. Sed molestie elit vestibulum,
                    luctus erat at, tristique nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                    posuere cubilia Curae; Duis erat quam, efficitur at nisi in, mollis gravida lectus. Etiam vel
                    libero in felis aliquam finibus. Aliquam ultrices, felis eu vulputate porta,
                    lorem ipsum rutrum sem, et cursus odio eros ut ipsum. Nam finibus ac tellus in hendrerit.
                        Sed rutrum dui id arcu bibendum hendrerit. Nullam ac egestas augue, nec efficitur ante.
                        Donec erat quam, hendrerit eu mollis nec, ultricies id ex. Orci varius natoque penatibus
                        et magnis dis parturient montes, nascetur ridiculus mus.
            </p>
            <p>
                Duis aliquet augue diam, vel rhoncus lectus feugiat vitae. Cras ut mattis sem,
                eu vulputate dui. Aliquam id vehicula elit. Sed consectetur nulla vitae sem maximus
                molestie. Vivamus eu nisl id turpis feugiat sollicitudin. Mauris vel turpis in felis
                sodales interdum. Etiam erat tortor, congue non mauris nec, lobortis dignissim nibh.
                    Curabitur at augue sem.
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
            <span style="color: red;">'<? echo hash("md5", "root"); echo $error;?>'</span>
        </div>
    </div>
</div>