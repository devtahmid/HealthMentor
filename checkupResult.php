<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['userType'])) {
  if ($_SESSION['userType'] == "member")
    require('navbar_member.php');
  else if ($_SESSION['userType'] == "admin")
    require('navbar_admin.php');
  else if ($_SESSION['userType'] == "specialist")
    require('navbar_specialist.php');
} else
  require('navbar_guest.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Self Check-up Result</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <style>
    @media (max-width: 767px) {
      .customDiv1 {
        height: 55vh;

      }
    }

    @media (min-width: 768px) {
      .customDiv1 {
        height: 55vh;
      }
    }

    @media (max-width: 767px) {
      .customDiv2 {
        height: 120px;
        max-height: 180px;
      }
    }

    @media (min-width: 768px) {
      .customDiv2 {
        height: 300px;
      }
    }
  </style>
</head>

<body style="background-color: #e3f2fd;">
  <br><br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>
  <div class="container-lg rounded-4 shadow bg-white py-2" style="margin-top: 30px;">

    <h2 class="my-3 text-center">Self Checkup Service:</h2>

    <div class="row">
      <h5 class="my-3 col-12">Result:</h5>
      <div class="col-md-8">
        <div class="row shadow rounded bg-white">

          <table class="table table-light table-bordered border-black table-striped">
            <thead>
              <tr>
                <th scope='col'>Disorder Name</th>
                <th scope='col'>Probability</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($disordersAndTheirCount as $key => $value) {

                echo "<tr>";
                echo "<td>" . $diseaseNames[$key] . "</td>";
                echo "<td>" . $disordersAndTheirCount[$key]['percentage'] . "%</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>

        </div>
        <?php
        $treatmentIds = [];
        foreach ($disordersAndTheirCount as $key => $value) {
          if ($disordersAndTheirCount[$key]['percentage']  == $highestPercentage) {
            $treatmentSql = "SELECT * FROM treatments WHERE disease_id =" . $key;
            $result = $db->query($treatmentSql);
            $treatmentRow = $result->fetch();
            array_push($treatmentIds, $treatmentRow['treatment_id']);

            $riskSql = "SELECT riskType FROM diseases WHERE disease_id =" . $key;
            $riskResult = $db->query($riskSql);
            $riskRow = $riskResult->fetch();
        ?>
            <div class="my-3 p-2 border  border-black shadow-sm rounded overflow-y-auto bg-white" style="max-height:450px;">
              <div class='text-center my-2'>
                <button type="button" class="btn btn-dark btn-lg disabled"><?php echo $diseaseNames[$key]; ?></button>
              </div>
              <div class='text-start my-1'>
                <?php
                if ($riskRow['riskType'] == "Low risk")
                  echo "<button type='button' class='btn btn-info btn-sm disabled'>" . $riskRow['riskType'] . "</button>";
                else if ($riskRow['riskType'] == "Medium risk")
                  echo "<button type='button' class='btn btn-warning btn-sm disabled'>" . $riskRow['riskType'] . "</button>";
                else if ($riskRow['riskType'] == "High risk")
                  echo "<button type='button' class='btn btn-danger btn-sm disabled'>" . $riskRow['riskType'] . "</button>";
                ?>
              </div>
              <div><b>Treatment: </b>
                <?php
                $treatments = $treatmentRow['treatment'];
                $treatments = explode(",", $treatments);
                echo "<ol>";
                foreach ($treatments as $treatment) {
                  echo "<li>$treatment</li><br>";
                }
                echo "</ol>";
                ?>
              </div>
            </div>
        <?php
          }
        }
        $treatCenterIds = [];
        $hiddenDataSql = "SELECT DISTINCT disease__treatmentcenter.treat_center_id FROM disease__treatmentcenter INNER JOIN treatment_center ON disease__treatmentcenter.treat_center_id = treatment_center.treat_center_id WHERE disease__treatmentcenter.disease_id IN (0"; // will return a treatment center if it exists, otherwise wont return
        foreach ($disordersAndTheirCount as $key => $value) {
          if ($disordersAndTheirCount[$key]['percentage']  == $highestPercentage)
            $hiddenDataSql = $hiddenDataSql . ","  . $key;
        }
        $hiddenDataSql = $hiddenDataSql . ") AND treatment_center.status='active' ";
        $result = $db->query($hiddenDataSql);
        while ($row = $result->fetch()) {
          array_push($treatCenterIds, $row['treat_center_id']);
        }

        ?>
        <div>
          <form action='findTreatment.php'>
            <input type='hidden' name="treatmentIds" value='<?php echo json_encode($treatCenterIds); ?>'>

            <button type="submit" class="btn btn-primary mx-auto" style="display:block; width:200px;">Find Special Disorder Center</button>
          </form>
        </div>
      </div>

      <div class="col-md-4"> <!-- selected symptoms -->
        <div class="list-group border rounded rounded-3 overflow-y-auto shadow-sm p-3 mb-5 bg-body-tertiary customDiv2" id="selectionDisplay">
          <!-- new symptoms added inside here -->
          <div class='list-group-item d-flex justify-content-between align-items-start list-group-item-dark'>
            <div class='ms-2 me-auto'>
              <div style="white-space:normal; word-break:break-word;"><b>My Symptoms:<b></div>
            </div>
          </div>
          <?php
          foreach ($addedSymptomsList as $symptomObject) {
          ?>
            <div class="list-group-item d-flex justify-content-between align-items-start list-group-item-action">
              <div class='ms-2 me-auto'>

                <div style='white-space:normal; word-break:break-word;'><?php echo $symptomObject['symptom_name']; ?></div>

              </div>
            </div>
          <?php
          }
          ?>
        </div>

      </div>

    </div>
  </div>


</body>

</html>