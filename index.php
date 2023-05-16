<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();


if (isset($_SESSION['userType'])) {
  if ($_SESSION['userType'] == "member")
    header('Location: memberDashboard.php');
  else if ($_SESSION['userType'] == "admin")
    header('Location: adminDashboard.php');
  else if ($_SESSION['userType'] == "specialist")
    header('Location: specialistDashboard.php');
} else
  header('Location: homepage.php');
