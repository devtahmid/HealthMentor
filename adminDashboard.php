<html>

<head>

  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</head>

<body>
  <?php
  require("navbar_admin.php");

  ?>
  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
  <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>

  <div style="margin:auto; width:30%; height:50%; margin-top: 10%;">
    <a class='btn btn-dark btn-lg d-block' href="userAccountManagement.php">User Account Management</a><br>
    <a class='btn btn-dark btn-lg d-block' href="new_disorder_form.php">Add Disorder</a><br>
    <a class='btn btn-dark btn-lg d-block' href="addTreatmentCenter.php">Add Treatment Center</a><br>
    <a class='btn btn-dark btn-lg d-block' href="delete_disorder.php">Delete Disorders</a><br>
    <a class='btn btn-dark btn-lg d-block' href="manageSpecialists.php">Manage Specialists</a><br>
    <a class='btn btn-dark btn-lg d-block' href="manageTreatmentCenters.php">Manage Special Disorder Centers</a><br>


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