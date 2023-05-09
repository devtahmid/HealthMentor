<?php
require('navbar_member.php');
try {

  require("project_connection.php");

  $sql = "select * FROM users WHERE role='specialist' AND userStatus='active'";
  $rs = $db->query($sql);
  $expertiseSql = "select * FROM `specialists-expertise` WHERE specialistId IN (SELECT id FROM users WHERE role='specialist' AND userStatus='active')";
  $expertiseRs = $db->query($expertiseSql);

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
  <title>Browse Specialists</title>
</head>

<body>


  <br /> <br />
  <br />

  <main class="container-md text-center">
    <div class="row">
      <?php

      if ($rs->rowcount() > 0) {

        foreach ($rs as $row) {

      ?>
          <div class="col mt-3">
            <div class="card" style="width: 18rem;">
              <img src="uploadedimages/<?php echo $row['profile_pic']; ?>">
              <div class="card-body">
                <h3 class="card-title"> <?php echo $row['name'] . $row['id']; ?></h3>
                <p class="card-text">
                <h5>Expertise:</h5> <br>
                <!-- <ul> -->
                <?php
                //echo  "line 57";
                foreach ($expertiseRs as $expertiseRow) {
                  //echo "1";
                  //echo "<li>" . $expertiseRow['specialistId'] . "</li>";
                  if ($expertiseRow['specialistId'] == $row['id']) {
                    echo "<li>" . $expertiseRow['expertise'] . "</li><br>";
                  }
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




</body>

</html>