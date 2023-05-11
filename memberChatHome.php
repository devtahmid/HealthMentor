<?php
require('navbar_member.php');
try {

  require("project_connection.php");

  $sql = "select * FROM users WHERE role='specialist' AND userStatus='active'";
  $rs = $db->prepare($sql);
  $rs->execute();
  $rows = $rs->fetchAll();
  $expertiseSql = "select * FROM `specialists-expertise` WHERE specialistId IN (SELECT id FROM users WHERE role='specialist' AND userStatus='active')";
  $expertiseRs = $db->prepare($expertiseSql);
  $expertiseRs->execute();
  $expertiseRows = $expertiseRs->fetchAll();

  /*   foreach ($expertiseRs as $exRx) {
    var_dump($exRx['expertise']);
  }
 */
  //$x = $rs->rowcount();
  $db = null;
} catch (PDOException $e) {
  die("Error Message" . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <title>Browse Specialists</title>
</head>

<body>

  <br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <main class="container-md">
    <div class="row">
      <?php
      if (count($rows) > 0) {

        foreach ($rows as $row) {

      ?>
          <div class="col mt-3">
            <div class="card" style="width: 18rem;">
              <img src="uploadedimages/<?php echo $row['profile_pic']; ?>" style="height:221px; width:286px; object-fit:cover;">
              <div class="card-body ">
                <h3 class="card-title text-center"> <?php echo $row['name']; ?></h3>
                <p class="card-text" style="text-align:start;">
                <h5>Expertise:</h5>
                <!-- <ul> -->
                <?php
                $flag = 0;
                foreach ($expertiseRows as $expertiseRow) {
                  if ($expertiseRow['specialistId'] == $row['id']) {
                    ++$flag;
                    if ($flag < 3)
                      echo "<li>" . $expertiseRow['expertise'] . "</li><br>";
                    elseif ($flag == 3) {
                      echo "<div style='display:none;'>";
                      echo "<li>" . $expertiseRow['expertise'] . "</li>";
                    } elseif ($flag > 3)
                      echo "<li>" . $expertiseRow['expertise'] . "</li>";
                  }
                }
                if ($flag >= 3) {
                  echo "</div>";
                  echo "<span class='text-info' onclick='displayMore(this)'>Show More</span>";
                }

                ?>
                <!-- </ul> -->
                </p>
              </div> <!-- end card body 1 -->


              <a class="btn btn-primary" href='chatpage.php?toId=<?php echo $row['id']; ?>'>Chat </a>

            </div>
          </div>

      <?php

        }
      }
      ?>
    </div>
  </main>

  <script>
    function displayMore(e) {
      //console.log(e);
      e.previousElementSibling.style.display = 'block';
      e.style.display = 'none';
    }
  </script>

</body>

</html>