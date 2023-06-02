<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("project_connection.php");

if (isset($_GET['removeUser'])) {
  $removeUser = $_GET['userId'];
  try {
    $sql = "UPDATE `users` SET `userStatus` = 'inactive' WHERE `id` = $removeUser";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
} elseif (isset($_GET['reinstateUser'])) {

  $reinstateUser = $_GET['userId'];
  try {
    $sql = "UPDATE `users` SET `userStatus` = 'active' WHERE `id` = $reinstateUser";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}


require("navbar_admin.php");

try {
  $sql = "SELECT * FROM `users` where role= 'specialist' ORDER BY userStatus ";
  $result = $db->query($sql);
  $rows = $result->fetchAll();

  $sql2 = "SELECT COUNT(*) FROM `users` where `userStatus` = 'active' AND role= 'specialist'";
  $countResult = $db->query($sql2);
  $count = $countResult->fetchColumn();
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Specialist Accounts</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
</head>

<body style="background-color: #e3f2fd;">

  <br><br><br>
  <div class='container-lg'>
    <div class="rounded-4 shadow bg-white py-3">
      <h4 class="mt-3 mb-2 mx-auto text-center"> Manage Specialist Accounts</h4>

      <div class="row ">

        <div class="col-xl-3 col-md-6 mb-4 ms-auto">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                    Number of total Specialist Accounts</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?php echo count($rows) ?> </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 me-auto">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">
                    Number of active specialist accounts</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?php echo $count; ?> </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive text-center">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider table align-middle">
              <?php
              $index = 0;
              foreach ($rows as $row) {
              ?>
                <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td style="white-space: pre-line;"><?php echo $row['email']; ?></td>
                  <td>
                    <form>
                      <input type="hidden" name='userId' <?php echo "value='" . $row['id'] . "'"; ?> />
                      <?php
                      if ($row['userStatus'] == 'active')
                        echo "<input type='submit' name='removeUser' class='btn btn-outline-danger btn-sm' value='Remove'/>";
                      else
                        echo "<input type='submit' name='reinstateUser' class='btn btn-outline-success btn-sm' value='Reinstate'/>";
                      ?>
                    </form>
                  </td>

                </tr>

              <?php
                ++$index;
              }
              ?>
            </tbody>
          </table>
        </div>

        <button class='btn btn-primary btn-md mx-auto text-center px-3 col-auto' id='addButton'>Add Treatment Center</button>

      </div>

      <!-- <div style="width:30%; margin-left:auto; margin-right:auto;" class="text-center">
        <a class='btn btn-dark d-block ' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="add_specialist_form.php">Add Specialist</a>
      </div> -->

    </div>
    <br>
    <div style="width:30%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
      <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php if (isset($_SESSION['userType'])) {
                                                                                                                                                  if ($_SESSION['userType'] == "member")
                                                                                                                                                    echo 'memberDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "admin")
                                                                                                                                                    echo 'adminDashboard.php';
                                                                                                                                                  else if ($_SESSION['userType'] == "specialist")
                                                                                                                                                    echo 'specialistDashboard.php';
                                                                                                                                                } else
                                                                                                                                                  echo 'homepage.php'; ?>">Return Home</a>
    </div>

  </div>
</body>

</html>