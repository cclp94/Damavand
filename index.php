<!DOCTYPE html>
<html>
    <head>
        <!-- ====== JS SCRIPTS ====== -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <!-- ========== CSS ========== -->
        <link rel="stylesheet" href="./css/bootstrap.min.css"/>
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="./css/style.css"/>
        <!-- ========================= -->
        <title>Damavand</title>
    </head>
    <body>
        <div id="main-container" class="container">
            <header>
                <div id="logo">
                    <img src="./img/logo.png"/>
                </div>
            </header>
            <div class="row">
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </nav>
            </div>
            <section id="content">
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
                                <input class="form-control" type="text" name="username" placeholder="User"/></br>
                                <input class="form-control" type="password" name="password" placeholder="Password"/></br>
                                <input  class="form-control" type="submit" value="Login"/>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="row">
                <div class="col-md-4 text-pad">
                    <p>
                    Duis aliquet augue diam, vel rhoncus lectus feugiat vitae. Cras ut mattis sem, eu vulputate dui.
                     Aliquam id vehicula elit. Sed consectetur nulla vitae sem maximus molestie.
                     Vivamus eu nisl id turpis feugiat sollicitudin. Mauris vel turpis in felis sodales interdum.
                      Etiam erat tortor, congue non mauris nec, lobortis dignissim nibh. Curabitur at augue sem.
                      </p>
                </div>
                <div class="col-md-4 copyright-container">
                    <span>Copyright Damavand Concordia University 2017</span>
                </div>
                <div class="col-md-4 footer-logo">
                    <img src="./img/logo.png"/>
                </div>
            </footer>
        </div>
    </body>
</html>
