<html>

<head>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
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
  require("navbar_member.php");
  if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();


  ?>

  <nav class="navbar" style="background-color: #9cd1f8;">
    <!-- <nav class="navbar" style="background-color: #90ccf4;"> -->
    <div class="container-fluid">
      <form class="d-flex mx-auto my-auto" role="search" onsubmit="return searchSelection(this)">
        <input type="text" list="searchService" class="form-control me-2" placeholder="search" id='searchBar'>
        <datalist id="searchService">

          <option value='Self Checkup'>
          <option value='My Health'>
          <option value='Special Disorder Centers'>
          <option value='Expert/Specialist'>
          <option value='Emergency'>

        </datalist>
        <button class=" btn btn-outline-primary" type="submit">Go</button>
      </form>
    </div>
  </nav>

  <br><br>
  <h1 style="text-align: center;">Self-Health Care</h1>
  <br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div style="margin:auto; width:30%; height:50%; margin-top: 10%;">

    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href='self_checkup_form.php'>Self Checkup</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="myHealth.php">My Health</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="specialDisorderCenters.php">Special Disorder Centers</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="memberChatHome.php">Expert/ Specialist</a><br>
    <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="emergency.php">Emergency</a><br>



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
      console.log(selection)
      selection = selection.trim().toLowerCase();

      if ("self checkup".includes(selection))
        window.location.href = "self_checkup_form.php";
      else if ("my health".includes(selection))
        window.location.href = "myHealth.php";
      else if ("special disorder centers".includes(selection))
        window.location.href = "specialDisorderCenters.php";
      else if ("expert/specialist".includes(selection))
        window.location.href = "memberChatHome.php";
      else if ("emergency".includes(selection))
        window.location.href = "emergency.php";
      else
        alert("Invalid Service");


      return false;
    }
  </script>

</body>

</html>