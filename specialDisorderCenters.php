<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("navbar_member.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Special Disorders Center</title>
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
  <div class="container-sm " style="margin-top: 30px;">
    <div class="rounded-4 shadow bg-white p-4 py-2">
      <h2 class="my-3 text-center">Special Disorders Center:</h2>
      <div class="row ">
        <div class="">
          <div class="row shadow rounded">



          </div>
          <?php
          require("project_connection.php");
          $sql = "SELECT * FROM treatment_center WHERE status='active'";
          $result = $db->query($sql);
          $rows = $result->fetchAll();

          foreach ($rows as $row) {
          ?>
            <div class="my-3 p-2 border row border-black rounded-3 overflow-y-auto bg-white" style="max-height:420px;">
              <div class="col-md-9 order-2 order-md-1">
                <div class='mt-2'>
                  <b><?php echo $row['center_name']; ?></b>
                </div>
                <div style="white-space: pre-line; margin-top:-30px;">

                  <?php echo $row['description']; ?>

                </div>
                <div><br> Treatment for:
                  <?php
                  $sqldiseases = "SELECT * FROM disease__treatmentcenter WHERE treat_center_id =" .  $row['treat_center_id'];
                  $resultdiseases = $db->query($sqldiseases);
                  $rowsdiseases = $resultdiseases->fetchAll();

                  $numberOfDisorders = count($rowsdiseases);
                  foreach ($rowsdiseases as $key => $rowdisease) {

                    $sqlDiseaseName = "SELECT disease from diseases WHERE disease_id = :diseaseId";
                    $resultDiseaseName = $db->prepare($sqlDiseaseName);
                    $resultDiseaseName->execute(array(':diseaseId' => $rowdisease['disease_id']));

                    $rowDiseaseName = $resultDiseaseName->fetch();
                    if ($key == $numberOfDisorders - 1)
                      echo $rowDiseaseName['disease'];
                    else
                      echo $rowDiseaseName['disease'] . ", ";
                  }


                  ?>
                </div>
              </div>
              <div class="col-md-3 order-1 order-md-2 text-center">
                <img src="uploadedimages/<?php echo $row['picture']; ?>" alt="center image" style="height: 200px; width:200px;">
              </div>
            </div>
          <?php
          }

          ?>
        </div>



      </div>


    </div>
    <div style="width:30%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
      <br>
      <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php if (isset($_SESSION['userType'])) {
                                                                                                                                                  if ($_SESSION['userType'] == "member")
                                                                                                                                                    echo 'memberDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "admin")
                                                                                                                                                    echo 'adminDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "specialist")
                                                                                                                                                    echo 'specialistDashboard.php';
                                                                                                                                                } else
                                                                                                                                                  echo 'homepage.php'; ?>">Return Home</a>
    </div>
  </div>
</body>

</html>