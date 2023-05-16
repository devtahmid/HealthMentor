<?php
//look at add disorder process for this code's version used properly
//below code is copy paste with only variables name not properly adjusted


if (!isset($_POST['centerName']))
  header('Location: add_specialist_form.php');

extract($_POST);
$addedExpertiseList = json_decode($addedDisordersList, true);

$name = htmlspecialchars(stripslashes(strip_tags($centerName)));
$email = htmlspecialchars(stripslashes(strip_tags($userEmail)));
$postPassword = htmlspecialchars(stripslashes(strip_tags($userPassword)));
$postPassword = md5($postPassword);

require("project_connection.php");

/* upload image */
$profile_pic="default.jpg"; //default image name
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
      die();
    } else {
      echo "line 76";
      $fdetails = explode(".", $_FILES["picfile"]["name"]);
      $fext = end($fdetails);
      $profile_pic = "pic" . $fdetails[0] . time() . uniqid(rand()) . ".$fext";  //file name
      if (move_uploaded_file($_FILES["picfile"]["tmp_name"], "./uploadedimages/$profile_pic")) {
        //Storage: uploadedimages/$fn;
        //we didnt enter img details into db yet
        $fileUploadFlag = true;
        echo "line 84";
      } else {
        $fileUploadFlag = false;
        echo "line88";
        header('location:add_specialist_form.php?error=1');
      }
    }
  } else {
    echo "Invalid file type or bigger than 5MB";
    header('location:add_specialist_form.php?error=1');
  }
} //end of new-file-upload if stmnt

//entering specialist into users table
try {
  $db->beginTransaction();
  $sql = "INSERT INTO `users`(`name`, `email`, `password`, `role`, `profile_pic` , `userStatus`) VALUES (:name,:email,:password,'specialist',:profile_pic , 'active')";
  $insert = $db->prepare($sql);
  $insert->bindParam(':name', $name);
  $insert->bindParam(':email', $email);
  $insert->bindParam(':password', $postPassword);
  $insert->bindParam(':profile_pic', $profile_pic);
  $insert->execute();
  $specialistId = $db->lastInsertId();
  $db->commit();
} catch (PDOException $e) {
  echo "we rolled back user insertion into table";
  echo $e->getMessage();
  $db->rollBack();
}

//entering expertise into db
try {
  $db->beginTransaction();
  $sql = "INSERT INTO `specialists-expertise` (`specialistId`, `expertise`) VALUES (:specialistId, :expertise)";
  $preparestatement = $db->prepare($sql);
  $newSymptomsId = [];
  foreach ($addedExpertiseList as $expertise) {
    $preparestatement->bindParam(':specialistId', $specialistId);
    $preparestatement->bindParam(':expertise', $expertise['disorder']);
    //as i said at the top, this wont make sense day after tomorrow
    $preparestatement->execute();
  }

  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  echo "line45" . $e->getMessage();
}

header('Location: additionSuccess.php?msg=Specialist successfully added! ');
