<?php
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
  <title>Add Treatment Center</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</head>

<body>
<br><br>
  <div class="mx-auto" style="width:150px; height:150px;">
  <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" colors="primary:#92140c,secondary:#f9c9c0" style="width:150px;height:150px">
    </lord-icon>
  </div>

  <div class="container-md" style="margin-top: 30px;">
    <h2 class="my-3 text-center">Add Treatment Center</h2>


    <form class="row" id="myForm" method='get' action="addTreatmentCenterProcess.php" onsubmit="return checkSubmitability()">

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

      <button class='btn btn-primary btn-md col-4 mx-auto disabled'>Add Treatment Center</button>
    </form>


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
      if (document.getElementById('centerName3').value.length > 0 && addedDisordersList.length > 0 && document.getElementById('moreDetails3').value.length > 0)
        document.querySelector('button').classList.remove('disabled');
      else
        document.querySelector('button').classList.add('disabled');
    }

    function checkSubmitability() {
      if (document.getElementById('centerName3').value.length > 0 && addedDisordersList.length > 0 && document.getElementById('moreDetails3').value.length > 0)
        return true;
      else
        return false;
    }
  </script>


</body>

</html>