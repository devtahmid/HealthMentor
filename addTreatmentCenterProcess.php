<?php
/* echo "<pre>";
var_dump($_GET);
echo "</pre>"; */

if (!isset($_GET['addedDisordersList']))
  header("Location: addTreatmentCenter.php");

extract($_GET);

$addedDisordersList = json_decode($addedDisordersList, true);

require("project_connection.php");

try {
  $db->beginTransaction();
  $sql = "INSERT INTO treatment_center (center_name, description) VALUES (:center_name, :description)";

  $preparestatement1 = $db->prepare($sql);
  $centerName = htmlspecialchars(stripslashes(strip_tags($centerName)));
  $description = htmlspecialchars(stripslashes(strip_tags($description)));
  $preparestatement1->bindParam('center_name', $centerName);
  $preparestatement1->bindParam('description', $description);
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
