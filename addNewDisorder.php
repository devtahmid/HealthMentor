<?php

if (!isset($_GET['disorderName']))
  header('Location: new_disorder_form.php');

extract($_GET);
$addedSymptomsList = json_decode($addedSymptomsList, true);

//in the db, disorder is called disease


require("project_connection.php");
//entering disease name into db
try {
  $db->beginTransaction();
  $sql = "INSERT INTO `diseases` (`disease`, `status` , `riskType`) VALUES (:disease , 'active' , :riskType)";
  $preparestatement = $db->prepare($sql);
  $preparestatement->bindParam(':disease', $disorderName);
  $preparestatement->bindParam(':riskType', $riskType);
  $preparestatement->execute();
  $disease_id = $db->lastInsertId();
  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  echo "line24:" . $e->getMessage();
}

//entering symptoms into db

try {
  $db->beginTransaction();
  $sql = "INSERT INTO `symptoms` (`symptom`) VALUES (:symptom)";
  $preparestatement = $db->prepare($sql);
  $newSymptomsId = [];
  foreach ($addedSymptomsList as $symp) {
    if ($symp['symptom_id'] == "-1") {
      $preparestatement->bindParam(':symptom', $symp['symptom']);
      $preparestatement->execute();
      $newSymptomsId[] = $db->lastInsertId();
    }
  }

  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  echo "line45" . $e->getMessage();
}
$treatment = htmlspecialchars(stripslashes(strip_tags($treatment)));
//adding treatment to db
try {
  $db->beginTransaction();
  $sql = "INSERT INTO `treatments` (`treatment`, `disease_id`) VALUES (:treatment, :disease_id)";
  $preparestatement = $db->prepare($sql);
  $preparestatement->bindParam(':treatment', $treatment);
  $preparestatement->bindParam(':disease_id', $disease_id);
  $preparestatement->execute();
  $treatment_id = $db->lastInsertId();
  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  echo "line59" . $e->getMessage();
}

//adding to disease_symptoms table

try {
  $db->beginTransaction();
  $sql = "INSERT INTO `disease_symptoms` (`disease_id`, `symptom_id`) VALUES (:disease_id, :symptom_id)";
  $preparestatement = $db->prepare($sql);
  foreach ($addedSymptomsList as $symp) {
    if ($symp['symptom_id'] == "-1") //check the form. -1 means users added a new symptom
      continue;
//old symptoms below
    $preparestatement->bindParam(':disease_id', $disease_id);
    $preparestatement->bindParam(':symptom_id', $symp['symptom_id']);
    $preparestatement->execute();
  }
  foreach ($newSymptomsId as $symp) { //new symptoms below
    $symp = htmlspecialchars(stripslashes(strip_tags($symp)));
    $preparestatement->bindParam(':disease_id', $disease_id);
    $preparestatement->bindParam(':symptom_id', $symp);
    $preparestatement->execute();
  }
  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  echo "line84" . $e->getMessage();
}

header('Location: additionSuccess.php?msg=Disorder successfully added! ');
