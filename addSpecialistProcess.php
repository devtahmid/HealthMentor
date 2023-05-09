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
//entering specialist into users table
$profile_pic = "default.jpg";
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
