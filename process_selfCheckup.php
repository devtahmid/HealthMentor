<?php

if (!isset($_GET['addedSymptomsList']))
  header('Location: self_checkup_form.php');

extract($_GET);
$addedSymptomsList = json_decode($addedSymptomsList, true);

//in the db, disorder is called disease
require("project_connection.php");
try {

  $sql = "SELECT * FROM disease_symptoms WHERE symptom_id = :symptom_id";
  $preparestatement1 = $db->prepare($sql);

  $sql2 = "SELECT * FROM diseases WHERE disease_id = :disease_id AND status='active'";

  $symptomsAndTheirDiseases = [];
  $index = 0;
  $diseaseNames = [];
  foreach ($addedSymptomsList as $symp) {
    $preparestatement1->bindParam(':symptom_id', $symp['symptom_id']);
    $preparestatement1->execute();
    $rows = $preparestatement1->fetchAll();
    //making the array on the bottom left of the srawing
    foreach ($rows as $row) {
      $symptomsAndTheirDiseases[$index][] = $row['disease_id'];

      $preparestatement2 = $db->prepare($sql2);
      $preparestatement2->bindParam(':disease_id', $row['disease_id']);
      $preparestatement2->execute();
      $rows2 = $preparestatement2->fetch();
      //print_r($rows2);
      //echo "next<br>";
      $diseaseNames[$row['disease_id']] = $rows2['disease'];
      //echo $rows2['disease'];
      //echo $index . "-" . $row['disease_id'] . "<br>";
    }

    ++$index;
  }
} catch (PDOException $e) {

  echo $e->getMessage();
}
//echo "<br>-----------line32----------<br>";
//var_dump($symptomsAndTheirDiseases);
//echo "<br>---------line34--------<br>";

//making the array on the bottom right of the drawing

$disordersAndTheirCount = []; //the index is the disease_id
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
//get the total number of symptoms for each disease
$sql3 = "SELECT COUNT(*) AS count FROM disease_symptoms WHERE disease_id = :disease_id";
$preparedtatement3 = $db->prepare($sql3);

$highestPercentage = 0;
foreach ($disordersAndTheirCount as $key => $value) {
  $preparedtatement3->bindParam(':disease_id', $key);
  $preparedtatement3->execute();
  $rows3 = $preparedtatement3->fetch();
  $disordersAndTheirCount[$key] = array();
  $disordersAndTheirCount[$key]['totalSymptoms'] = $rows3['count'];
  $disordersAndTheirCount[$key]['percentage'] = round((($value / $rows3['count']) * 100), 2);
  if ($disordersAndTheirCount[$key]['percentage'] > $highestPercentage)
    $highestPercentage = $disordersAndTheirCount[$key]['percentage'];
}

/*
echo "<br<-----------line51----------<br>";
var_dump($disordersAndTheirCount);
echo "<br>---------line53--------<br>";
echo $totalCount; */

//if user logged in, take his userid and add to history
session_start();
if (isset($_SESSION['userId'])) {
  try {
    $sqlSaveResult = "INSERT INTO checkup_history (user_id, date, result_in_json) VALUES (:user_id, DATE_FORMAT(CURDATE(), '%Y-%m-%d'), :result_in_json)";
    $stmt = $db->prepare($sqlSaveResult);
    $stmt->bindParam(':user_id', $_SESSION['userId']);
    $jsonencodeddata = json_encode($disordersAndTheirCount);
    $stmt->bindParam(':result_in_json', $jsonencodeddata);
    $stmt->execute();
    //echo $db->lastInsertId();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
//echo "----".$_SESSION['userId']."-----";
//echo json_encode($disordersAndTheirCount);
//display result
require_once('checkupResult.php');
