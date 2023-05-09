<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();


if (isset($_SESSION['userId'])) {
  if ($_SESSION['userType'] == "admin")
    header('Location: adminDashboard.php');
  elseif ($_SESSION['userType'] == "member")
    header('Location: memberDashboard.php');
  elseif ($_SESSION['userType'] == "specialist")
    header('Location: specialistDashboard.php');
} else {
  header('Location: login.php');
}
