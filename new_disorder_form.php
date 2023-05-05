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
  $json_rows = json_encode($rowCleaned);
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


    <form class="row" id="myForm" action="newSubscriptionController.php">

      <div class="mb-3">
        <label for="disorderName3" class="form-label">Disorder Name</label>
        <input type="text" class="form-control" id="disorderName3">

      </div>


      <div class="row mb-1">
        <label class="form-label">Enter Symptoms</label>
        <!-- <label for="addSymptom3" class="col-sm-3 col-form-label">New symptom</label> -->
        <div class="col-9 ">
          <input type="text" class="form-control" placeholder='New symptom' id="addSymptom3">
        </div>
        <a class='btn btn-outline-success btn-sm col-3 fw-bolder' onclick="addSymptom('addSymptom3')">+</a>
      </div>

      <div class="row mb-1 mx-2 form-text">Or</div>


      <div class="row mb-4" id="chooseSymptom">
        <div class="col-9 ">
          <select class="form-select" onselect='test()'>
            <option value="" disabled selected>Select from existing symptoms</option>
            <?php
            foreach ($rows as $row) {
              echo "<option value='" . $row['symptom_id'] . "'>" . $row['symptom'] . "</option>";
            }
            ?>

          </select>
        </div>
        <a class='btn btn-outline-success btn-sm col-3 fw-bolder'>+</a>
      </div>

      <!-- symptoms added by user below -->

      <div class="row mb-2" id='addedSymptomsList'>
        <div class="col-9 ">
          <input type="text" class="form-control" value='New symptom' disabled>
        </div>
        <a class='btn btn-outline-danger btn-sm col-3 fw-bolder'>-</a>
      </div>
      <div class="row mb-3" id='addedSymptomsList'>
        <div class="col-9 ">
          <input type="text" class="form-control" value='New symptom' disabled>
        </div>
        <a class='btn btn-outline-danger btn-sm col-3 fw-bolder'>-</a>
      </div>



      <div class="row mb-3">
        <label for="treatment3" class="col-form-label">Treatment</label>
        <div class="">
          <input type="text" class="form-control" id="treatment3">
        </div>
      </div>

      <button class='btn btn-primary btn-md col-4 mx-auto disabled'>Add disorder</button>
    </form>

    <!-- dropdown displaying all the results-->



  </div>

  <script>
    var jsonSymptomsData = JSON.parse('<?php echo $json_rows; ?>');





    function addSymptom(id) {
      var toAdd = document.getElementById(id).value;

      if (toAdd.length == 0)
        return;

      createRow(toAdd);
      document.getElementById(id).value = '';

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
      thisElement.parentNode.remove();
    }

    function test() {
      console.log('dffdfd')
    }
  </script>


</body>

</html>