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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Self Check-up History</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <style>
    @media (max-width: 767px) {
      .customDiv1 {
        height: 55vh;

      }
    }

    @media (min-width: 768px) {
      .customDiv1 {
        height: 55vh;
      }
    }

    @media (max-width: 767px) {
      .customDiv2 {
        height: 120px;
        max-height: 180px;
      }
    }

    @media (min-width: 768px) {
      .customDiv2 {
        height: 300px;
      }

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
    }
  </style>
</head>

<body>
  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div class="container-md" style="margin-top: 30px;">
    <h2 class="my-3 text-center">Check-up History:</h2>
    <div class="row ">
      <div class="">
        <div class="row shadow rounded">

          <?php
          require('project_connection.php');
          if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
          $userId = $_SESSION['userId'];
          $sql = "SELECT * FROM checkup_history WHERE user_id = '$userId' ORDER BY date DESC";
          $result = $db->query($sql);
          $rows = $result->fetchAll();
          ?>
          <table class="table table-bordered border-black table-striped">
            <thead>
              <tr>
                <th scope='col'>Date Checked</th>
                <th scope='col'>Result</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sqlDisorderName = "SELECT disease FROM diseases WHERE disease_id = :disease_id";
              $preparedstmt = $db->prepare($sqlDisorderName);

              foreach ($rows as $row) {
                $jsonResult = json_decode($row['result_in_json'], true);
                echo "<tr>";
                echo "<td >" . $row['date'] . "</td>";
                $resultCleaned = "";
                foreach ($jsonResult as $key => $row) {
                  $preparedstmt->bindParam(':disease_id', $key);
                  $preparedstmt->execute();
                  $disorderName = $preparedstmt->fetch();
                  $resultCleaned .= $disorderName['disease'] . ":" . $jsonResult[$key]['percentage'] . "% <br>";
                }
                $resultCleaned = rtrim($resultCleaned, " ,");
                echo "<td>" . $resultCleaned . "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>

        </div>


      </div>


    </div>



</body>

</html>