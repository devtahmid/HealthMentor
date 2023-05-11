<?php
require("project_connection.php");

if (isset($_GET['removeUser'])) {
  $removeUser = $_GET['userId'];
  try {
    $sql = "UPDATE `users` SET `userStatus` = 'inactive' WHERE `id` = $removeUser AND role= 'member'";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}elseif (isset($_GET['reinstateUser'])) {

  $reinstateUser = $_GET['userId'];
  try {
    $sql = "UPDATE `users` SET `userStatus` = 'active' WHERE `id` = $reinstateUser AND role= 'member'";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();

  }
}


require("navbar_admin.php");

try {
  $sql = "SELECT * FROM `users` where role= 'member'";
  $result = $db->query($sql);
  $rows = $result->fetchAll();

  $sql2 = "SELECT COUNT(*) FROM `users` where `userStatus` = 'active' AND role= 'member'";
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
  <title>Manage User Accounts</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <br><br><br>
  <div class='container-lg'>
    <h4 class="mt-3 mb-2 mx-auto text-center"> Manage User Accounts</h4>

    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4 ms-auto">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                  Number of total User Accounts</div>
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
                  Number of active accounts</div>
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

    </div>
  </div>
</body>

</html>