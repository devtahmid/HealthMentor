<?php

extract($_POST);
session_start();
$fromId = $_SESSION['userId'];
require('project_connection.php');
try {
  $db->beginTransaction();
  $currentDateTime = new DateTime();
  $formattedDate = $currentDateTime->format('Y-m-d H:i:s');
  $sqlInsertMessage = "INSERT INTO messages (dateTime, fromId, toId, message) VALUES ( :dateTime ,:fromId, :toId, :message)";

  $stmtInsertMessage = $db->prepare($sqlInsertMessage);
  $stmtInsertMessage->bindParam(':dateTime', $formattedDate);
  $stmtInsertMessage->bindParam(':fromId', $fromId);
  $stmtInsertMessage->bindParam(':toId', $toId);
  $stmtInsertMessage->bindParam(':message', $message);
  $stmtInsertMessage->execute();

  $db->commit();
} catch (PDOException $e) {
  echo $e->getMessage();
}

header('Location: chatpage.php?toId=' . $toId);
