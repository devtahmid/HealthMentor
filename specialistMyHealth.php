<?php

if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();


require("navbar_specialist.php");
if (isset($_GET['memberId'])) {


  require('project_connection.php');
  $userId = $_GET['memberId'];
  $sql = "SELECT * FROM checkup_history WHERE user_id = '$userId' ORDER BY date DESC";
  $result = $db->query($sql);
  $rows = $result->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Check-up History</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
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
    }
  </style>
</head>

<body style="background-color: #e3f2fd;">
  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div class="container-md " style="margin-top: 30px;">
    <div class="rounded-4 shadow bg-white p-3">
      <h2 class="my-3 text-center">Member Check-up History:</h2>
      <div class="row ">
        <div class="vstack gap-3">
          <div class="row shadow rounded"> <!-- only search -->
            <form>
              <label for="searchHistory" class="col-sm-3 col-md-4 col-form-label">Enter Member ID</label>

              <input type="text" id='searchHistory' name='memberId' class="form-control col-sm-6 col-md-5">
              <button type="submit" class="btn btn-dark col-sm-3 col-md-3">Search</button>
            </form>
          </div>
          <div class="row shadow-sm rounded">
            <table class="table table-light table-bordered border-black table-striped">
              <thead>
                <tr>
                  <th scope='col'>Date Checked</th>
                  <th scope='col'>Result</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_GET['memberId'])) {

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
                }
                ?>
              </tbody>
            </table>

          </div>


        </div>
      </div>
    </div>
    <div style="width:40%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
      <br>
      <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php
                                                                                                                                                echo 'specialistDashboard.php';
                                                                                                                                                ?>">Return Home</a>
    </div>
  </div>



</body>

</html>