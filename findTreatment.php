<?php

//var_dump($_GET);
$treatCenterIds = json_decode($_GET['treatmentIds'], true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Treatment Service</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

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

<body>

  <div class="container-sm" style="margin-top: 70px;">
    <h2 class="my-3 text-center">Treatment Service:</h2>
    <div class="row ">
      <div class="">
        <div class="row shadow rounded">



        </div>
        <?php
        require("project_connection.php");
        $sql = "SELECT * FROM treatment_center WHERE treat_center_id = :treat_center_id";
        $preparestatement = $db->prepare($sql);
        foreach ($treatCenterIds as $treat_center_id) {
          $preparestatement->bindParam(':treat_center_id', $treat_center_id);
          $preparestatement->execute();
          $treatmentRow = $preparestatement->fetch();

          if (!isset($treatmentRow['center_name']))
            continue;
        ?>
          <div class="my-3 p-2 border  border-black shadow-sm rounded overflow-y-auto" style="max-height:420px;">
            <div class='mt-2'>
              <b><?php echo $treatmentRow['center_name']; ?></b>
            </div>
            <div style="white-space: pre-line; margin-top:-25px;">

              <?php echo $treatmentRow['description']; ?>

            </div>
          </div>
        <?php
        }

        ?>
      </div>



    </div>



</body>

</html>