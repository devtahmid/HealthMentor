<?php
/* echo "<pre>";
var_dump($_GET);
echo "</pre>"; */

if (!isset($_POST['addedDisordersList']))
  header("Location: addTreatmentCenter.php");

extract($_POST);

$addedDisordersList = json_decode($addedDisordersList, true);

require("project_connection.php");
/* upload image */
$fn="defaultTreatmentCenter.png"; //default image name
if (isset($_FILES["picfile"]["name"])) { //if statement to decide if new pic uploaded
  if ((($_FILES["picfile"]["type"] == "image/gif")
      || ($_FILES["picfile"]["type"] == "image/jpeg")
      || ($_FILES["picfile"]["type"] == "image/png")
      || ($_FILES["picfile"]["type"] == "image/jpg")
      || ($_FILES["picfile"]["type"] == "image/pjpeg"))
    && ($_FILES["picfile"]["size"] < 5000000)
  ) {
    if ($_FILES["picfile"]["error"] > 0) {
      echo "Return Code:" . $_FILES["picfile"]["error"] . "<br>";
    } else {
      echo "line 76";
      $fdetails = explode(".", $_FILES["picfile"]["name"]);
      $fext = end($fdetails);
      $fn = "pic" . $fdetails[0] . time() . uniqid(rand()) . ".$fext";  //file name
      if (move_uploaded_file($_FILES["picfile"]["tmp_name"], "./uploadedimages/$fn")) {
        //Storage: uploadedimages/$fn;
        //we didnt enter img details into db yet
        $fileUploadFlag = true;
        echo "line 84";
      } else {
        $fileUploadFlag = false;
        echo "line88";
        header('location:addTreatmentCenter.php?error=1');
      }
    }
  } else {
    echo "Invalid file type or bigger than 5MB";
    header('location:addTreatmentCenter.php?error=1');
  }
} //end of new-file-upload if stmnt



try {
  $db->beginTransaction();
  $sql = "INSERT INTO treatment_center (center_name, description, status, picture) VALUES (:center_name, :description, 'active' , :picture)";

  $preparestatement1 = $db->prepare($sql);
  $centerName = htmlspecialchars(stripslashes(strip_tags($centerName)));
  $description = htmlspecialchars(stripslashes(strip_tags($description)));
  $preparestatement1->bindParam('center_name', $centerName);
  $preparestatement1->bindParam('description', $description);
  $preparestatement1->bindParam('picture', $fn); //todo: profile pic for specialist, then test form
  $preparestatement1->execute();
  $rows = $preparestatement1->fetch();
  $treatment_centerId = $db->lastInsertId();
  $db->commit();
} catch (PDOException $e) {

  echo $e->getMessage();
}


try {

  $sql = "INSERT INTO disease__treatmentcenter (disease_id, treat_center_id) VALUES (:disease_id, :treat_center_id)";
  $db->beginTransaction();
  $preparestatement1 = $db->prepare($sql);
  foreach ($addedDisordersList as $disorderRow) {

    $preparestatement1->bindParam(':disease_id', $disorderRow['disorder_id']);
    $preparestatement1->bindParam(':treat_center_id', $treatment_centerId);
    $preparestatement1->execute();
  }
  $db->commit();
} catch (PDOException $e) {

  echo $e->getMessage();
}
header('Location: additionSuccess.php?msg=Treatment Center successfully added! ');
