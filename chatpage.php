<?php
session_start();

if (!isset($_SESSION['userId']))
  header('Location:login.php');


$fromId = $_SESSION['userId'];
$toId = $_GET['toId'];
require('project_connection.php');
try {
  $sqlAllMessages = "SELECT * FROM messages WHERE (fromId = :fromId AND toId = :toId) OR (fromId = :toId AND toId = :fromId)";
  $stmtAllMessages = $db->prepare($sqlAllMessages);
  $stmtAllMessages->bindParam(':fromId', $fromId);
  $stmtAllMessages->bindParam(':toId', $toId);
  $stmtAllMessages->execute();
  $allMessages = $stmtAllMessages->fetchAll();

  $toUserName = "SELECT DISTINCT name from users WHERE id = :toId";
  $stmtToUser = $db->prepare($toUserName);
  $stmtToUser->bindParam(':toId', $toId);
  $stmtToUser->execute();
  $toUserName = $stmtToUser->fetch();
} catch (PDOException $e) {
  echo $e->getMessage();
}


if ($_SESSION['userType'] == "member")
  require('navbar_member.php');
else if ($_SESSION['userType'] == "admin")
  require('navbar_admin.php');
else if ($_SESSION['userType'] == "specialist")
  require('navbar_specialist.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <title>Chat</title>
</head>

<body style="background-color: #e3f2fd; width:100vw;">
  <div class="container-md border border-3 border-black bg-white" style="margin-bottom:32px;  position:relative; bottom:2px; height:100vh; overflow-y:auto;">
    <div class="row ">
      <?php

      foreach ($allMessages as $message) {
        if ($message['fromId'] == $fromId) {
          echo '<div class="col-12 text-end"><b>Me</b><br> ' . $message['message'] . '</div>';
        } else {
          echo "<div class='col-12 text-start'><b>" . $toUserName['name'] . "</b><br>" . $message['message'] . "</div>";
        }
      }

      ?>

    </div>
  </div>
  <div class="container-md fixed-bottom ">
    <div class="border shadow-sm">
      <form action="processMessage.php" method="post" style="margin-bottom: 0px;">
        <div class="row">
          <div class="col-10 px-0">
            <input type="text" name="message" class="form-control w-100" placeholder="Type your message here">
          </div>
          <div class="col-2 px-0">
            <input type="hidden" name="toId" value="<?php echo $toId; ?>">
            <button type="submit" class="btn btn-primary  w-100">Send</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</body>

</html>