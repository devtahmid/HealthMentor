<html>

<head>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</head>

<body>
  <?php
  require("navbar_specialist.php");
  session_start();

  ?>
  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div style="margin:auto; width:30%; height:50%; margin-top: 10%;">
    <a class='btn btn-dark btn-lg d-block' href="specialistMyHealth.php">Member Checkup History</a><br>
    <a class='btn btn-dark btn-lg d-block' href="specialistChatHome.php">Chat with members</a><br>


  </div>
  <?php

  $alertMsg = null;
  extract($_GET);
  if ($alertMsg == 1) {
    echo "<script> alert('Pharmacist Added!'); </script>";
  } elseif ($alertMsg == 2) {
    echo "<script> alert('Pharmacist Deleted'); </script>";
  }

  ?>
</body>

</html>