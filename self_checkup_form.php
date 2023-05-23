<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();

require("project_connection.php");
try {
  $sql = "SELECT * FROM symptoms WHERE symptom_id IN (SELECT symptom_id FROM disease_symptoms WHERE disease_id IN (SELECT disease_id FROM diseases WHERE status = 'active'))";
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
  <title>Self Check-up</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
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
  <div class="container-lg" style="margin-top: 30px;">
    <h2 class="my-3 text-center">Self Checkup Service:</h2>

    <div class="row border  border-black shadow rounded bg-white"><!-- includes selected symptoms -->
      <div class="col-md-8" style="height:45vh"> <!-- search + list -->
        <div class="row shadow-sm rounded"> <!-- only search -->

          <label for="searchSymptom" class="col-sm-3 col-md-5 col-form-label">Search Symptoms</label>

          <input type="text" list="disorderSearch" id='searchSymptom' class="form-control col-sm-9 col-md-7" onchange="searchSelection(event)">
          <datalist id="disorderSearch">
            <?php
            foreach ($rows as $row)
              echo "<option value='" . $row['symptom'] . "'>";

            ?>
          </datalist>

        </div>
        <div class="list-group mt-5 border  border-black shadow-sm rounded overflow-y-auto" style="max-height:220px;"> <!-- only list -->
          <?php
          foreach ($rows as $row)
            echo "<div class='list-group-item d-flex justify-content-between align-items-start list-group-item-action'>
            <div class='ms-2 me-auto'>
              <div id='" . $row['symptom_id'] . "'>" . $row['symptom'] . "</div>

            </div>
            <span class='badge bg-secondary rounded-pill' onClick='listSelection(event)'>+</span>
          </div>";
          ?>

        </div>
      </div>

      <div class="col-md-4"> <!-- selected symptoms -->
        <div class="list-group mt-5 border rounded rounded-3 overflow-y-auto shadow p-3 mb-5 bg-body-tertiary customDiv2" id="selectionDisplay">
          <!-- new symptoms added inside here -->
          <div class='list-group-item d-flex justify-content-between align-items-start list-group-item-dark'>
            <div class='ms-2 me-auto'>
              <div style="white-space:normal; word-break:break-word;"><b>My Symptoms:<b></div>
            </div>
          </div>
        </div>

      </div>

      <form action='process_selfCheckup.php'>
        <input type='hidden' name="addedSymptomsList" value='' id='hiddenData'>
        <button type="submit" class="btn btn-primary " id='submitButton' disabled>Submit</button>
      </form>

    </div>
    <div style="width:30%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
      <br>
      <a class='btn btn-dark btn-lg d-block' style="background-image: linear-gradient(0deg, rgb(0, 172, 238) 0%, rgb(2, 126, 251) 100%);" href="<?php if (session_status() !== PHP_SESSION_ACTIVE)
                                                                                                                                                  session_start();
                                                                                                                                                if (isset($_SESSION['userType'])) {
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
    var jsonSymptomsData = JSON.parse('<?php echo $json_rows; ?>');
    var addedSymptomsList = [];

    function searchSelection(event) {
      event.preventDefault();
      flag = 0;

      //to check if already added
      for (var i = 0; i < addedSymptomsList.length; i++)
        if (addedSymptomsList[i].symptom_name == event.target.value) {
          flag = 1;
          break;
        }


      if (flag == 0) //to check if what TO BE entered is a valid symptom
        for (var i = 0; i < jsonSymptomsData.length; i++)
          if (jsonSymptomsData[i].symptom == event.target.value) {
            var symptom_id = jsonSymptomsData[i].symptom_id;
            var symptom_name = jsonSymptomsData[i].symptom;
            var symptomObject = {
              symptom_id: symptom_id,
              symptom_name: symptom_name
            };
            addedSymptomsList.push(symptomObject);
            flag = 2;
            //enter to display menu
            addObjectToDisplay(symptomObject);
            break;
          }

      if (flag == 2)
        event.target.value = ''
    }

    function listSelection(event) {
      var targetElement = event.target.parentElement.firstElementChild.firstElementChild;
      var flag = 0;
      for (var i = 0; i < addedSymptomsList.length; i++) {
        console.log(addedSymptomsList[i].symptom_name, targetElement.innerText)
        if (addedSymptomsList[i].symptom_name == targetElement.innerText) {
          flag = 1;
          break;
        }
      }
      if (flag == 0) {
        var symptom_id = targetElement.id;
        var symptom_name = targetElement.innerText;
        var symptomObject = {
          symptom_id: symptom_id,
          symptom_name: symptom_name
        };
        addedSymptomsList.push(symptomObject);
        //enter to display menu
        addObjectToDisplay(symptomObject);
      }
    }

    function addObjectToDisplay(symptomObject) {
      var div = document.createElement('div');
      div.className = 'list-group-item d-flex justify-content-between align-items-start list-group-item-action';
      div.innerHTML = "<div class='ms-2 me-auto'><div style='white-space:normal; word-break:break-word;'>" + symptomObject.symptom_name + "</div></div><span class='badge bg-danger rounded-pill my-auto' onclick='removeObjectFromDisplay(this)'>X</span>";
      document.getElementById('selectionDisplay').appendChild(div);

      document.getElementById('hiddenData').value = JSON.stringify(addedSymptomsList);

      document.getElementById('submitButton').removeAttribute('disabled');

    }

    function removeObjectFromDisplay(item) {

      for (var i = 0; i < addedSymptomsList.length; i++)
        if (addedSymptomsList[i].symptom_name == item.parentElement.firstElementChild.firstElementChild.innerText) {
          addedSymptomsList.splice(i, 1);
          break;
        }

      item.parentNode.remove()

      document.getElementById('hiddenData').value = JSON.stringify(addedSymptomsList);

      if (addedSymptomsList.length == 0)
        document.getElementById('submitButton').disabled = true;
    }
  </script>

</body>

</html>