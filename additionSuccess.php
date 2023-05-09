<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Addition Success</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php
  session_start();
  if ($_SESSION['userType'] == "admin")
    require("navbar_admin.php");
  else
    require("navbar_member.php");

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
  </div>
</body>

</html>