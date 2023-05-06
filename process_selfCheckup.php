<?php

if (!isset($_GET['addedSymptomsList']))
  header('Location: self_checkup_form.php');

extract($_GET);
$addedSymptomsList = json_decode($addedSymptomsList, true);

//in the db, disorder is called disease
require("project_connection.php");
try {

  $sql = "SELECT `disease_id` FROM disease_symptoms WHERE symptom_id = :symptom_id";
  $preparestatement = $db->prepare($sql);

  $symptomsAndTheirDiseases = [];
  $index = 0;
  foreach ($addedSymptomsList as $symp) {
    $preparestatement->bindParam(':symptom_id', $symp['symptom_id']);
    $preparestatement->execute();
    $rows = $preparestatement->fetchAll();
    //making the array on the bottom left of the srawing
    foreach ($rows as $row) {
      $symptomsAndTheirDiseases[$index][] = $row['disease_id'];
      echo $index . "-" . $row['disease_id'] . "<br>";
    }

    ++$index;
  }
} catch (PDOException $e) {

  echo $e->getMessage();
}
echo "<br>-----------line32----------<br>";
//var_dump($symptomsAndTheirDiseases);
echo "<br>---------line34--------<br>";

//making the array on the bottom right of the drawing

$disordersAndTheirCount = [];
$totalCount = 0;

foreach ($symptomsAndTheirDiseases as $symptom) {
  for ($i = 0; $i < count($symptom); $i++) {
    if (isset($disordersAndTheirCount[$symptom[$i]]))
      ++$disordersAndTheirCount[$symptom[$i]];
    else
      $disordersAndTheirCount[$symptom[$i]] = 1;
    ++$totalCount;
  }
}

/* echo "<br<-----------line51----------<br>";
var_dump($disordersAndTheirCount);
echo "<br>---------line53--------<br>";
echo $totalCount; */

//if user logged in, take his userid and add to history

//display result

