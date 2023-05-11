<?php
require("project_connection.php");

if (isset($_GET['markAsRead'])) {
  $messageId = $_GET['messageId'];
  try {
    $sql = "UPDATE `customer_support_messages` SET `status` = 'read' WHERE `c_id` = $messageId";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
} elseif (isset($_GET['markAsUnread'])) {

  $messageId = $_GET['messageId'];
  try {
    $sql = "UPDATE `customer_support_messages` SET `status` = 'unread' WHERE `c_id` = $messageId";
    $result = $db->query($sql);
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}


require("navbar_admin.php");

try {
  $sql = "SELECT * FROM `customer_support_messages` ORDER BY status DESC, dateTime ASC";
  $result = $db->query($sql);
  $rows = $result->fetchAll();

  $sql2 = "SELECT COUNT(*) FROM `customer_support_messages` where `status` = 'unread'";
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
  <title>Customer Messages</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <br><br><br>
  <div class='container-lg'>
    <h4 class="mt-3 mb-2 mx-auto text-center"> Customer Messages</h4>

    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4 ms-auto">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                  Total Number of Messages Received</div>
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
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1 text-center">
                  Number of unread messages</div>
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
              <th scope="col">Phone</th>
              <th scope="col">Message</th>
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
                <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
                <td><?php echo $row['phone']; ?></td>
                <td style="white-space: pre-line;"><?php echo $row['message']; ?></td>
                <td>
                  <form>
                    <input type="hidden" name='messageId' <?php echo "value='" . $row['c_id'] . "'"; ?> />
                    <?php
                    if ($row['status'] == 'unread')
                      echo "<input type='submit' name='markAsRead' class='btn btn-outline-success btn-sm' value='Mark as read'/>";
                    else
                      echo "<input type='submit' name='markAsUnread' class='btn btn-outline-primary btn-sm' value='Mark as Unread'/>";
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