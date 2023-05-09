<?php
session_start();
$specialistId = $_SESSION['userId'];
require("navbar_specialist.php");

require_once("project_connection.php");

$sqlFetchMessages = "SELECT DISTINCT fromId FROM messages WHERE  toId = $specialistId";
$result = $db->query($sqlFetchMessages);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Chat with members</title>
</head>

<body>

  <br /> <br />
  <br />

  <main class="container-md">
    <div class="row">

      <?php
      foreach ($result as $memberRow) {
        $sqlMemberDetails = "SELECT name FROM users WHERE id =" . $memberRow['fromId'];
        $memberDetails = $db->query($sqlMemberDetails);
        $firstRow = $memberDetails->fetch();
      ?>
        <div class="card">

          <div class="card-body">
            <h5 class="card-title"><?php echo $firstRow['name']; ?></h5>
            <p class="card-text">User Id: <?php echo $memberRow['fromId']; ?></p>
            <a href="chatpage.php?toId=<?php echo $memberRow['fromId']; ?>" class="btn btn-primary">Chat</a>
          </div>
        </div>

      <?php
      }
      ?>


    </div>
  </main>
</body>

</html>