<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Addition Success</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
</head>

<body style="background-color: #e3f2fd;">
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
  <div class="container-md" style="margin-top: 130px;">
    <!-- circle with tick svg from https://icons8.com/icons/set/check-->
    <div class="container d-flex justify-content-center align-items-center">

      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 171 171" style=" fill:#000000;">
        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
          <path d="M0,171.99074v-171.99074h171.99074v171.99074z" fill="none" stroke="none" stroke-width="1"></path>
          <g>
            <path d="M85.5,164.5875c-43.605,0 -79.0875,-35.4825 -79.0875,-79.0875c0,-43.605 35.4825,-79.0875 79.0875,-79.0875c43.605,0 79.0875,35.4825 79.0875,79.0875c0,43.605 -35.4825,79.0875 -79.0875,79.0875z" fill="#bae0bd" stroke="none" stroke-width="1"></path>
            <path d="M85.5,8.55c42.3225,0 76.95,34.6275 76.95,76.95c0,42.3225 -34.6275,76.95 -76.95,76.95c-42.3225,0 -76.95,-34.6275 -76.95,-76.95c0,-42.3225 34.6275,-76.95 76.95,-76.95M85.5,4.275c-44.8875,0 -81.225,36.3375 -81.225,81.225c0,44.8875 36.3375,81.225 81.225,81.225c44.8875,0 81.225,-36.3375 81.225,-81.225c0,-44.8875 -36.3375,-81.225 -81.225,-81.225z" fill="#5e9c76" stroke="none" stroke-width="1"></path>
            <path d="M47.88,85.9275l24.795,24.795l56.43,-56.43" fill="none" stroke="#ffffff" stroke-width="12.825">
            </path>
          </g>
        </g>
      </svg>
    </div>
    <h2 class="container d-flex justify-content-center align-items-center" style="text-transform: none;"><?php echo $_GET['msg']; ?>
    </h2>
    <div style="width:40%; margin-left:auto; margin-right:auto;">
      <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php if (session_status() !== PHP_SESSION_ACTIVE)
                                                                                                                                                  session_start();
                                                                                                                                                if (isset($_SESSION['userType'])) {
                                                                                                                                                  if ($_SESSION['userType'] == "member")
                                                                                                                                                    echo 'memberDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "admin")
                                                                                                                                                    echo 'adminDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "specialist")
                                                                                                                                                    echo 'specialistDashboard.php';
                                                                                                                                                } else
                                                                                                                                                  echo 'homepage.php'; ?>">Return Home</a><br>
    </div>
  </div>
</body>

</html>