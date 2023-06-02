<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("project_connection.php");

if (isset($_GET['deleteDisorder'])) {
  $deleteDisorder = $_GET['disorderId'];
  try {
    $sql = "UPDATE `diseases` SET `status` = 'inactive' WHERE `disease_id` = $deleteDisorder";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
} elseif (isset($_GET['reinstateDisorder'])) {

  $reinstateDisorder = $_GET['disorderId'];
  try {
    $sql = "UPDATE `diseases` SET `status` = 'active' WHERE `disease_id` = $reinstateDisorder";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

require("navbar_admin.php");

try {
  $sql = "SELECT * FROM `diseases`";
  $result = $db->query($sql);
  $rows = $result->fetchAll();


  $sqlCount = "SELECT COUNT(*) FROM `diseases` where `status` = 'active'";
  $countResult = $db->query($sqlCount);
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
  <title>Delete Disorders</title>
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
  <div class='container-lg '>
    <div class="rounded-4 shadow bg-white py-3">
      <h4 class="mt-3 mb-2 mx-auto text-center"> Delete Disorder</h4>

      <div class="row">

        <div class="col-xl-4 col-md-6 mb-4 ms-auto">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                    Total Number of Disorders</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?php echo count($rows) ?> </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-4 col-md-6 mb-4 me-auto">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">
                    Number of Disorders active</div>
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
          <table class="table table-bordered table-sm border-black">
            <thead>
              <tr>
                <th scope="col">Disorder Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider table align-middle">
              <?php
              $index = 0;
              foreach ($rows as $row) {
              ?>
                <tr>
                  <td><?php echo $row['disease']; ?></td>

                  <td>
                    <form>
                      <input type="hidden" name='disorderId' <?php echo "value='" . $row['disease_id'] . "'"; ?> />
                      <?php
                      if ($row['status'] == 'active')
                        echo "<input type='submit' name='deleteDisorder' class='btn btn-outline-danger btn-sm' value='Remove'/>";
                      else
                        echo "<input type='submit' name='reinstateDisorder' class='btn btn-outline-success btn-sm' value='Reinstate'/>";
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