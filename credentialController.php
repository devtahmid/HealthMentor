<?php
require_once('project_connection.php');
$emailRegex = '/^[a-zA-Z0-9._-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z.]{2,5}$/';
$passwordRegex = '/^[0-9A-Za-z]{5,16}$/';

if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();


if (isset($_SESSION['userId'])) {
  if ($_SESSION['userType'] == "admin")
    header('Location: adminDashboard.php');
  elseif ($_SESSION['userType'] == "member")
    header('Location: memberDashboard.php');

  exit();
}

if (!isset($_POST['submit']))
  header('Location: login.php');
elseif ($_POST['submit'] == 'Login') {  // if login clicked
  if (!preg_match($emailRegex, $_POST['email'])) {
    $error = "invalid email format";
    header('Location: login.php?error=' . $error);
  } elseif (!preg_match($passwordRegex, $_POST['password'])) {
    $error = "invalid password format";
    header('Location: login.php?error=' . $error);
  } else { //input formats are valid. now check if in db

    //sanitize user input
    $postEmail = htmlspecialchars(stripslashes(strip_tags($_POST['email'])));
    $postPassword = htmlspecialchars(stripslashes(strip_tags($_POST['password'])));
    $postPassword = md5($postPassword); //hashed password
    echo $postPassword;
    $sql = "SELECT * FROM users WHERE email = :email AND password = :password AND userStatus = 'active'";
    $queriedResult = $db->prepare($sql);
    $queriedResult->bindParam(':email', $postEmail);
    $queriedResult->bindParam(':password', $postPassword);
    $queriedResult->execute();

    $userRow = $queriedResult->fetch();
    //var_dump($userRow);
    if ($queriedResult->rowCount() == 0) {
      $error = "wrong email or password";
      header('Location: login.php?error=' . $error);
    } else { //email and password found in db
      if (session_status() !== PHP_SESSION_ACTIVE)
        session_start();

      $_SESSION['userId'] = $userRow['id'];

      if ($userRow['role'] == "member") {
        $_SESSION['userType'] = "member";
        header('Location: memberDashboard.php');
      } elseif ($userRow['role'] == "specialist") {
        $_SESSION['userType'] = "specialist";
        header('Location: specialistDashboard.php');
      } else {
        $_SESSION['userType'] = "admin";
        header('Location: adminDashboard.php');
      }
    }
  }
} elseif ($_POST['submit'] == 'Signup') {   //if sign up clicked

  if (!preg_match($emailRegex, $_POST['email'])) {
    $error2 = "invalid email format";
    header('Location: login.php?error=' . $error);
  } elseif ($_POST['password'] != $_POST['confirm_password']) {
    $error2 = "passwords do not match";
    header('Location: login.php?error=' . $error);
  } elseif (!preg_match($passwordRegex, $_POST['password']) || !preg_match($passwordRegex, $_POST['confirm_password'])) {
    $error2 = "invalid password format";
    header('Location: login.php?error=' . $error);
  } //name regex is not checked!!
  else {
    $userId;
    //all inputs are valid. now insert into db

    //but first sanitize user input
    $postName = htmlspecialchars(stripslashes(strip_tags($_POST['name'])));
    $postEmail = htmlspecialchars(stripslashes(strip_tags($_POST['email'])));
    $postPassword = htmlspecialchars(stripslashes(strip_tags($_POST['password'])));
    $postPassword = md5($postPassword); //hashed password
    // register user as a member

    $profile_pic = "default.jpg";
    try {
      $db->beginTransaction();
      $sql = "INSERT INTO `users`(`name`, `email`, `password`, `role`, `profile_pic` , `userStatus`) VALUES (:name,:email,:password,'member',:profile_pic , 'active')";
      $insert = $db->prepare($sql);
      $insert->bindParam(':name', $postName);
      $insert->bindParam(':email', $postEmail);
      $insert->bindParam(':password', $postPassword);
      $insert->bindParam(':profile_pic', $profile_pic);
      $insert->execute();
      $userId = $db->lastInsertId();
      $db->commit();
      //echo "user id is " . $userId;
    } catch (PDOException $e) {
      echo "we rolled back user insertion into table";
      echo $e->getMessage();
      $db->rollBack();
    }

//adding security answer into db
try {
  $db->beginTransaction();
  $sql = "INSERT INTO `forgot_password_answers`(`user_id`, `question`, `answer`) VALUES (:userId,:question ,:answer)";
  $insert = $db->prepare($sql);
  $insert->bindParam(':userId', $userId);
  $insert->bindParam(':question', $_POST['security_question']);
  $insert->bindParam(':answer', $_POST['security_answer']);
  $insert->execute();
  $db->commit();
} catch (PDOException $e) {
  echo "we rolled back security answer insertion into the table ";
  echo $e->getMessage();
  $db->rollBack();
}


//echo "user id is " . $userId;

    $_SESSION['userId'] = $userId;
    $_SESSION['userType'] = 'member';
    //echo "user id is " . $_SESSION['userId'];
    header('Location: memberDashboard.php');
  }
}
