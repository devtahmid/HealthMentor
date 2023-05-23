<html>

<head>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
</head>

<body style="background-color: #e3f2fd;" style="height:100vh;">
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
  <div class="container-md" style="margin-top: 100px;">
    <h2 class="text-center">Are you in an emergency? Press the button below and help will reach you soon</h2>

    <a href='tel:999' style='display:block; margin-top:150;'>
      <div style='height:100px; width:100px; display:block; margin:auto;'><img src="assets/call1.png" alt='999' style='max-width:100%'></div>
    </a>

  </div>
</body>

</html>