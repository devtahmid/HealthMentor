<?php

require("project_connection.php");

try {

  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $_POST['email']);
  $stmt->execute();
  $row = $stmt->fetch();

  $sqlCheckRecovery = "SELECT * FROM forgot_password_answers WHERE user_id =:user_id";
  $stmtCheckRecovery = $db->prepare($sqlCheckRecovery);
  $stmtCheckRecovery->bindValue(':user_id', $row['id']);
  $stmtCheckRecovery->execute();
  $rowCheckRecovery = $stmtCheckRecovery->fetch();
} catch (PDOException $e) {
  echo $e->getMessage();
}
if (!count($row) >= 1)
  header("Location: login.php?error=Email not found");


if ($rowCheckRecovery['question'] == $_POST['security_question'] && $rowCheckRecovery['answer'] == $_POST['security_answer']) {

  session_start();
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['userType'] = $row['role'];

  if ($_SESSION['userType'] == "member")
    require('memberDashboard.php');
  else if ($_SESSION['userType'] == "admin")
    require('adminDashboard.php');
  else if ($_SESSION['userType'] == "specialist")
    require('specialistDashboard.php');
} else {

  header("Location: login.php?error=Wrong answer to security question");
}
