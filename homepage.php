<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>HOMEPAGE</title>

</head>

<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE)
        session_start();
    if (isset($_SESSION['userType'])) {
        if ($_SESSION['userType'] == "member")
            require('navbar_member.php');
        else if ($_SESSION['userType'] == "admin")
            require('navbar_admin.php');
        else if ($_SESSION['userType'] == "specialist")
            require('navbar_specialist.php');
    } else
        require('navbar_guest.php');
    ?>
    <main>
        <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
        <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" style="width:140px;height:140px">
        </lord-icon>
        <h1>AbleMind</h1>
    </main>
    <article>
        <!-- partial:index.partial.html -->
        <div class="carousel">
            <div class="carousel__control">
            </div>
            <div class="carousel__stage">
                <div class="spinner spinner--left">
                    <div class="spinner__face js-active" data-bg="#777">
                        <div class="content" data-type="iceland">
                            <div class="content__left">

                            </div>
                            <div class="content__right">
                                <div class="content__main">
                                    <h1>Do you Know ?</h1>
                                    <p>“Half of all lifetime mental illness begins by age 14, and 75% by age 24.” </p>

                                </div>
                                <h3 class="content__index">01</h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner__face" data-bg="#19304a">
                        <div class="content" data-type="china">
                            <div class="content__left">

                            </div>
                            <div class="content__right">
                                <div class="content__main">
                                    <h1>Do you Know ?</h1>
                                    <p>“The human body has less muscles in it than a caterpillar."”</p>
                                    <p>– Damian Harper</p>
                                </div>
                                <h3 class="content__index">02</h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner__face" data-bg="#2b2533">
                        <div class="content" data-type="usa">
                            <div class="content__left">

                            </div>
                            <div class="content__right">
                                <div class="content__main">
                                    <h1>Do you Know ?</h1>
                                    <p>“Depression is a common mental disorder. Globally, it is estimated that 5% of adults suffer from depression” </p>

                                </div>
                                <h3 class="content__index">03</h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner__face" data-bg="#008000">
                        <div class="content" data-type="peru">
                            <div class="content__left">

                            </div>
                            <div class="content__right">
                                <div class="content__main">
                                    <h1>Do you Know ?</h1>
                                    <p>“Going for a Medical Checkup regularly can reduce your risk of getting sick.”</p>

                                </div>
                                <h3 class="content__index">04</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Poor man's preloader -->
        <div style="height: 0; width: 0; overflow: hidden">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/peru.jpg">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/canada.jpg"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/china.jpg"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/usa.jpg"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/iceland.jpg">
        </div>
        <!-- partial -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script src="./c.js"></script>

    </article>
    <div class="services">
        <a href="login.php">
            <h1>Services:</h1>
        </a>
    </div>
    <footer>
        <div class="first">
            <a href="self_checkup_form.php">
                <button class="custom-btn btn-12"><span>Click!</span><span>Self Checkup</span></button></a>
        </div>
        <div class="second">
            <a href="myHealth.php">
                <button class="custom-btn btn-13"><span>Click!</span><span>My Health</span></button></a>
        </div>
        <div class="forth">
            <button class="custom-btn btn-15"><span>Click!</span><span>Games</span></button>
        </div>
    </footer>



</body>

</html>