<html>

<head>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</head>

<body>
  <?php
  require("navbar_admin.php");

  ?>
  <nav class="navbar" style="background-color: #e3f2fd;">
    <!-- <nav class="navbar" style="background-color: #90ccf4;"> -->
    <div class="container-fluid">
      <form class="d-flex mx-auto my-auto" role="search" onsubmit="return searchSelection(this)">
        <input type="text" list="searchService" class="form-control me-2" placeholder="search" id='searchBar'>
        <datalist id="searchService">

          <option value='User Account Management'>
          <option value='Customer Messages'>
          <option value='Add Disorder'>
          <option value='Delete Disorders'>
          <option value='Add Special Disorder Center'>
          <option value='Manage Special Disorder Centers'>
          <option value='Manage Specialists'>

        </datalist>
        <button class=" btn btn-outline-primary" type="submit">Go</button>
      </form>
    </div>
  </nav>
  <br>
  <h1 style="text-align: center;">Self-Health Care</h1>
  <br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>

  <div style="margin:auto; width:30%; height:50%; margin-top: 10%;">

    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="userAccountManagement.php">User Account Management</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="customer_support.php">Customer Messages</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="new_disorder_form.php">Add Disorder</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="delete_disorder.php">Delete Disorders</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="addTreatmentCenter.php">Add Special Disorder Center</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="manageTreatmentCenters.php">Manage Special Disorder Centers</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="manageSpecialists.php">Manage Specialists</a><br>


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


  <script>
    function searchSelection() {
      var selection = document.getElementById("searchBar").value;
      console.log(selection);
      selection = selection.trim().toLowerCase();

      if ("user account management".includes(selection))
        window.location.href = "userAccountManagement.php";
      else if ("customer messages".includes(selection))
        window.location.href = "customer_support.php";
      else if ("add disorder".includes(selection))
        window.location.href = "new_disorder_form.php";
      else if ("delete disorders".includes(selection))
        window.location.href = "delete_disorder.php";
      else if ("add special disorder center".includes(selection))
        window.location.href = "addTreatmentCenter.php";
      else if ("manage special disorder centers".includes(selection))
        window.location.href = "manageTreatmentCenters.php";
      else if ("manage specialists".includes(selection))
        window.location.href = "manageSpecialists.php";
      else
        alert("Invalid Service");

      return false;
    }
  </script>

</body>

</html>