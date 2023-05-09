<?php
require('navbar_member.php');
try {

  require("project_connection.php");

  $sql = "select * FROM users WHERE role='specialist' AND userStatus='active'";
  $rs = $db->query($sql);
  $expertiseSql = "select * FROM `specialists-expertise` WHERE specialistId IN (SELECT id FROM users WHERE role='specialist' AND userStatus='active')";
  $expertiseRs = $db->query($expertiseSql);
  //$x = $rs->rowcount();
  $db = null;
} catch (PDOException $e) {
  die("Error Message" . $e->getMessage());
}
?>

<br /><br />
<section> <!-- class="text-center" removed -->
  <div class="container align-items-center">
    <!--<table class="table table-borderless"> -->
    <table class="table table-borderless">

      <?php
      foreach ($rs as $row) {

        echo "<div class='row'>"; //row begins

        echo "<div class='col-3 col-md-3' col-sm-12>"; //column for image
        echo "<img src='uploadedimages/" . $row['profile_pic'] . "' height='250px' width='250px'/><br /><br />";

        echo "</div>"; // end image column

        echo "<div class='col-9 col-md-9' col-sm-12>"; //column for data

        echo "<h3 class='text'>" . $row["name"] . "</h3><br />";
        echo "<h5 class='text'>Expertise: </h5><br>";
        echo "<ul>";
        foreach ($expertiseRs as $expertiseRow)
          if ($expertiseRow['specialistId'] == $row['id']) {
            echo "<li><h4 class='text'>" . $expertiseRow['expertise'] . "</h4></li><br>";
          }
        echo "</ul>";
        echo "<h5 class='text'>Email: " . $row["email"] . "</h5><br />";

        /* echo "<form method='get' action='view.php'>";
        echo "<input type='hidden' name='id' value='" . $row["ID"] . "'/><br />";
        echo "<input class='btn btn-secondary btn-lg btn-block' type='submit' name='view' value='View More Details'/> <br />";
        echo "</form>"; */

        if ($_SESSION['userType'] == 'Pharmacist') {
          echo "<form method='get' action='../pharmacist/viewSupplier.php'>";
          echo "<input type='hidden' name='id' value='" . $row["ID"] . "'/><br />";
          echo "<input class='btn btn-secondary btn-lg btn-block' type='submit' name='view' value='View supplier'/> <br />";
          echo "</form>";
        }

        echo "</div> <br />"; // end of data column
      ?>
        <script>
          var uniID = '_' + Math.random().toString(36).substr(2, 9);
        </script>
      <?php
        //echo $uniID."= <script> uniID </script>";
        //timer($date, $uniID);
        //echo '<h3 id='.json_encode($uniID).' class="text-bold text-primary">loading...</h3><br />';
        ################################################

        echo "</div>"; //end of row
      }
      ?>

  </div>
  </table>
</section>
<br /> <br /> <br />
</body>

</html>