<?php

if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("project_connection.php");
try {
  $sql = "SELECT * FROM diseases where status = 'active'";
  $result = $db->query($sql);
  $rows = $result->fetchAll();
  $db = null;
  $rowCleaned = [];
  foreach ($rows as $row) {
    $toPush = [];
    $toPush['disease_id'] = $row['disease_id'];
    $toPush['disease'] = $row['disease'];
    array_push($rowCleaned, $toPush);
  }
  $json_rows = json_encode($rowCleaned, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}


require("navbar_admin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Special Disorder Center</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
</head>

<body style="background-color: #e3f2fd;">
  <br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>

  <div class="container-md" style="margin-top: 30px;">
    <div class="rounded-4 shadow bg-white p-3">
      <h2 class="my-3 text-center">Add Treatment Center</h2>


      <form class="row" id="myForm" action="addTreatmentCenterProcess.php" onsubmit="return checkSubmitability()" method='post' enctype="multipart/form-data">

        <div class="mb-3">
          <label for="centerName3" class="form-label">Center Name</label>
          <input type="text" class="form-control" id="centerName3" name='centerName' onkeyup="toggleButtonColour()" required>

        </div>


        <div class="row mb-3" id='chooseDisorder'>
          <label class="form-label">Disorders Treated by the center</label>

          <div class="col-9 ">
            <select class="form-select" id='selectSymptom'>
              <option value="" disabled selected>Select from existing disorders</option>
              <?php
              foreach ($rows as $row) {
                echo "<option value='" . $row['disease_id'] . "'>" . $row['disease'] . "</option>";
              }
              ?>

            </select>
          </div>
          <a class='btn btn-outline-success btn-sm col-3 fw-bolder' onclick="addSymptom('selectSymptom')">+</a>
        </div>

        <!-- disorders added by user will appear below -->

        <input type='hidden' name='addedDisordersList' value='' id='hiddenData' />

        <div class="row mb-3">
          <label for="moreDetails3" class="col-form-label">More details</label>
          <div class="">
            <textarea type="text" class="form-control" id="moreDetails3" name='description' onkeyup="toggleButtonColour()" required></textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label for="picture3" class="col-form-label">Upload an image (image<=5MB) </label>
              <div class="">
                <input type="file" class="form-control" id="picture3" name='picfile'>
              </div>
        </div>

        <button class='btn btn-primary btn-md col-4 mx-auto disabled' id='addButton'>Add Treatment Center</button>
      </form>

      <?php
      if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<script> alert('File could not be uploaded'); </script>";
      }
      ?>

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

  <script>
    var addedDisordersList = [];



    function addSymptom(id) {
      var toAdd = document.getElementById(id).value;

      if (toAdd.length == 0)
        return;

      if (id == 'selectSymptom') {
        toAdd = document.getElementById(id).options[document.getElementById(id).selectedIndex].text;
        toAddId = document.getElementById(id).value;
      }
      //loop through the list to check if the symptom is already added
      for (var i = 0; i < addedDisordersList.length; i++)
        if (addedDisordersList[i].disorder == toAdd)
          return;

      createRow(toAdd);
      addedDisordersList.push({
        'disorder_id': toAddId,
        'disorder': toAdd
      });
      document.getElementById('hiddenData').value = JSON.stringify(addedDisordersList);
      document.getElementById(id).value = '';

      toggleButtonColour();
    }



    function createRow(toAdd) {
      var disorderInputDiv = document.createElement('div');
      if (addedDisordersList.length > 0)
        disorderInputDiv.className = 'row mb-2';
      else
        disorderInputDiv.className = 'row mb-3';

      disorderInputDiv.innerHTML = `<div class="col-9 ">
          <input type="text" class="form-control" value='${toAdd}' disabled>
        </div>
        <a class='btn btn-outline-danger btn-sm col-3 fw-bolder' onClick='removeInput(this)'>-</a>`;

      document.getElementById('chooseDisorder').insertAdjacentElement("afterend", disorderInputDiv);
    }

    function removeInput(thisElement) {
      toRemove = thisElement.previousElementSibling.firstElementChild.value;
      for (var i = 0; i < addedDisordersList.length; i++) {
        if (addedDisordersList[i].disorder == toRemove) {
          addedDisordersList.splice(i, 1);
          document.getElementById('hiddenData').value = JSON.stringify(addedDisordersList);
          break;
        }
      }
      thisElement.parentNode.remove();

      toggleButtonColour();
    }

    function toggleButtonColour() {
      console.log(document.getElementById('centerName3').value.length, addedDisordersList.length > 0, document.getElementById('moreDetails3').value.length);

      if (document.getElementById('centerName3').value.length > 0 && addedDisordersList.length > 0 && document.getElementById('moreDetails3').value.length > 0)
        document.getElementById('addButton').classList.remove('disabled');
      else
        document.getElementById('addButton').classList.add('disabled');
    }

    function checkSubmitability() {
      if (document.getElementById('centerName3').value.length > 0 && addedDisordersList.length > 0 && document.getElementById('moreDetails3').value.length > 0) {
        if (confirm("Are you sure you want to add this Disorder Center?"))
          return true;
        else
          return false;
      } else
        return false;
    }
  </script>


</body>

</html>