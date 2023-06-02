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
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <title>Chat with members</title>
</head>

<body style="background-color: #e3f2fd;">

  <br /> <br />
  <br />

  <main class="container-md">
    <div class="row">

      <?php
      foreach ($result as $memberRow) {
        $sqlMemberDetails = "SELECT name, profile_pic FROM users WHERE id =" . $memberRow['fromId'];
        $memberDetails = $db->query($sqlMemberDetails);
        $firstRow = $memberDetails->fetch();
      ?>
        <div class="card">
          <div class="row g-0 align-items-center" style="max-height:289px;">

            <div class="col-4 mh-100 ">
              <img src="uploadedimages/<?php echo $firstRow['profile_pic']; ?>" class="img-fluid rounded-start mh-100" alt="...">
            </div>
            <div class="col-8">

              <div class="card-body">
                <h5 class="card-title"><?php echo $firstRow['name']; ?></h5>
                <h6 class="card-title">Member ID: <?php echo $memberRow['fromId']; ?></h6>
                <a class="card-text" href="specialistMyHealth.php?memberId=<?php echo $memberRow['fromId']; ?>">User Self-check result history </a><br>
                <a href="talkpage.php?toId=<?php echo $memberRow['fromId']; ?>" class="btn btn-primary mt-1">Chat</a>
              </div>
            </div>
          </div>

        <?php
      }
        ?>


        </div>

        <div style="width:40%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
          <br>
          <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php
                                                                                                                                                    echo 'specialistDashboard.php';
                                                                                                                                                    ?>">Return Home</a>
        </div>
  </main>
</body>

</html>