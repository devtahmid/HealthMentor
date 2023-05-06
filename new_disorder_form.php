<?php
require("project_connection.php");
try {
  $sql = "SELECT * FROM symptoms";
  $result = $db->query($sql);
  $rows = $result->fetchAll();
  $db = null;
  $rowCleaned = [];
  foreach ($rows as $row) {
    $toPush = [];
    $toPush['symptom_id'] = $row['symptom_id'];
    $toPush['symptom'] = $row['symptom'];
    array_push($rowCleaned, $toPush);
  }
  $json_rows = json_encode($rowCleaned, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
  <title>Add Disorder</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container-md" style="margin-top: 70px;">
    <h2 class="my-3 text-center">Add disorder</h2>


    <form class="row" id="myForm" method='get' action="addNewDisorder.php" onsubmit="return checkSubmitability()">

      <div class="mb-3">
        <label for="disorderName3" class="form-label">Disorder Name</label>
        <input type="text" class="form-control" id="disorderName3" name='disorderName' onkeyup="toggleButtonColour()" required>

      </div>


      <div class="row mb-1">
        <label class="form-label">Enter Symptoms</label>

        <div class="col-9 ">
          <select class="form-select" id='selectSymptom'>
            <option value="" disabled selected>Select from existing symptoms</option>
            <?php
            foreach ($rows as $row) {
              echo "<option value='" . $row['symptom_id'] . "'>" . $row['symptom'] . "</option>";
            }
            ?>

          </select>
        </div>
        <a class='btn btn-outline-success btn-sm col-3 fw-bolder' onclick="addSymptom('selectSymptom')">+</a>
      </div>

      <div class="row mb-1 mx-2 form-text">Or</div>


      <div class="row mb-4" id="chooseSymptom">
        <div class="col-9 ">
          <input type="text" class="form-control" placeholder='New symptom' id="addSymptom3">
        </div>
        <a class='btn btn-outline-success btn-sm col-3 fw-bolder' onclick="addSymptom('addSymptom3')">+</a>
      </div>

      <!-- symptoms added by user will appear below -->

      <input type='hidden' name='addedSymptomsList' value='' id='hiddenData' />

      <div class="row mb-3">
        <label for="treatment3" class="col-form-label">Treatment</label>
        <div class="">
          <input type="text" class="form-control" id="treatment3" name='treatment' onkeyup="toggleButtonColour()" required>
        </div>
      </div>

      <button class='btn btn-primary btn-md col-4 mx-auto disabled'>Add disorder</button>
    </form>

    <!-- dropdown displaying all the results-->



  </div>

  <script>
    var jsonSymptomsData = JSON.parse('<?php echo $json_rows; ?>');
    var addedSymptomsList = [];



    function addSymptom(id) {
      var toAdd = document.getElementById(id).value;

      if (toAdd.length == 0)
        return;
      toAddId = '-1';
      if (id == 'selectSymptom') {
        toAdd = document.getElementById(id).options[document.getElementById(id).selectedIndex].text;
        toAddId = document.getElementById(id).value;
      }
      //loop through the list to check if the symptom is already added
      for (var i = 0; i < addedSymptomsList.length; i++)
        if (addedSymptomsList[i].symptom == toAdd)
          return;

      createRow(toAdd);
      addedSymptomsList.push({
        'symptom_id': toAddId,
        'symptom': toAdd
      });
      document.getElementById('hiddenData').value = JSON.stringify(addedSymptomsList);
      document.getElementById(id).value = '';

      toggleButtonColour();
    }



    function createRow(toAdd) {
      var symptomInputDiv = document.createElement('div');
      if (addedSymptomsList.length > 0)
        symptomInputDiv.className = 'row mb-2';
      else
        symptomInputDiv.className = 'row mb-3';

      symptomInputDiv.innerHTML = `<div class="col-9 ">
          <input type="text" class="form-control" value='${toAdd}' disabled>
        </div>
        <a class='btn btn-outline-danger btn-sm col-3 fw-bolder' onClick='removeInput(this)'>-</a>`;

      document.getElementById('chooseSymptom').insertAdjacentElement("afterend", symptomInputDiv);
    }

    function removeInput(thisElement) {
      toRemove = thisElement.previousElementSibling.firstElementChild.value;
      for (var i = 0; i < addedSymptomsList.length; i++) {
        if (addedSymptomsList[i].symptom == toRemove) {
          addedSymptomsList.splice(i, 1);
          document.getElementById('hiddenData').value = JSON.stringify(addedSymptomsList);
          break;
        }
      }
      thisElement.parentNode.remove();

      toggleButtonColour();
    }

    function toggleButtonColour() {
      if (document.getElementById('disorderName3').value.length > 0 && addedSymptomsList.length > 0 && document.getElementById('treatment3').value.length > 0)
        document.querySelector('button').classList.remove('disabled');
      else
        document.querySelector('button').classList.add('disabled');
    }

    function checkSubmitability() {
      if (document.getElementById('disorderName3').value.length > 0 && addedSymptomsList.length > 0 && document.getElementById('treatment3').value.length > 0)
        return true;
      else
        return false;
    }
  </script>


</body>

</html>