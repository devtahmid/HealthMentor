<?php
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

  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div class="container-sm" style="margin-top: 30px;">
    <h2 class="my-3 text-center">Special Disorders Center:</h2>
    <div class="row ">
      <div class="">
        <div class="row shadow rounded">



        </div>
        <?php
        require("project_connection.php");
        $sql = "SELECT * FROM treatment_center";
        $result = $db->query($sql);
        $rows = $result->fetchAll();

        foreach($rows as $row) {
        ?>
          <div class="my-3 p-2 border  border-black shadow-sm rounded overflow-y-auto" style="max-height:420px;">
            <div class='mt-2'>
              <b><?php $row['center_name']; ?></b>
            </div>
            <div style="white-space: pre-line; margin-top:-25px;">

              <?php echo $row['description']; ?>

            </div>
          </div>
        <?php
        }

        ?>
      </div>



    </div>



</body>

</html>