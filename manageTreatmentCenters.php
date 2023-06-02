<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("project_connection.php");

if (isset($_GET['removeCenter'])) {
  $removeCenter = $_GET['centerId'];
  try {
    $sql = "UPDATE `treatment_center` SET `status` = 'inactive' WHERE `treat_center_id` = $removeCenter";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
} elseif (isset($_GET['reinstateCenter'])) {

  $reinstateCenter = $_GET['centerId'];
  try {
    $sql = "UPDATE `treatment_center` SET `status` = 'active' WHERE `treat_center_id` = $reinstateCenter";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}


require("navbar_admin.php");

try {
  $sql = "SELECT * FROM `treatment_center`";
  $result = $db->query($sql);
  $rows = $result->fetchAll();

  $sql2 = "SELECT COUNT(*) FROM `treatment_center` where `status` = 'active'";
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
  <title>Manage Special Disorder Centers</title>
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
    <div class="rounded-4 shadow bg-white  py-3">
      <h4 class="mt-3 mb-2 mx-auto text-center"> Manage Special Disorder Centers</h4>

      <div class="row">

        <div class="col-xl-3 col-md-6 mb-4 ms-auto">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                    Total Number of Special Disorder Centers</div>
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
                    Number of active Special Disorder Centers</div>
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
                <th scope="col">Special Disorder Center Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider table align-middle">
              <?php
              $index = 0;
              foreach ($rows as $row) {
              ?>
                <tr>
                  <td><?php echo $row['center_name']; ?></td>
                  <td style="white-space: pre-line;"><?php echo $row['description']; ?></td>
                  <td>
                    <form>
                      <input type="hidden" name='centerId' <?php echo "value='" . $row['treat_center_id'] . "'"; ?> />
                      <?php
                      if ($row['status'] == 'active')
                        echo "<input type='submit' name='removeCenter' class='btn btn-outline-danger btn-sm' value='Remove'/>";
                      else
                        echo "<input type='submit' name='reinstateCenter' class='btn btn-outline-success btn-sm' value='Reinstate'/>";
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
      </div>
    </div>
    <div style="width:40%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
      <br>
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