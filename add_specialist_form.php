<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();


require("navbar_admin.php");

//EXPERTISE IS 150 CHAR MAX
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Specialist</title>
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
      <h2 class="my-3 text-center">Add Specialist</h2>


      <form class="row" id="myForm" method='post' action="addSpecialistProcess.php" onsubmit="return checkSubmitability()" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="centerName3" class="form-label">Specialist Name</label>
          <input type="text" class="form-control" id="centerName3" name='centerName' onkeyup="toggleButtonColour()" minlength='2' required>
        </div>


        <div class="mb-3">
          <label for="userEmail3" class="form-label">Specialist Email</label>
          <input type="text" class="form-control" id="userEmail3" name='userEmail' onkeyup="toggleButtonColour()" required>
        </div>


        <div class="mb-3">
          <label for="userPassword" class="form-label">Specialist Password</label>
          <input type="password" class="form-control" id="userPassword" name='userPassword' onkeyup="toggleButtonColour()" required>
        </div>


        <div class="row mb-3" id="chooseSymptom">
          <label class="form-label" for='selectSymptom'>Enter Areas of Expertise</label>
          <div class="col-9 ">
            <input type="text" class="form-control" id="selectSymptom" maxlength="150">
          </div>
          <a class='btn btn-outline-success btn-sm col-3 fw-bolder' onclick="addSymptom('selectSymptom')">+</a>
        </div>

        <div class="row mb-4">
          <label for="picture3" class="col-form-label">Upload specialist image (image<=5MB) </label>
              <div class="">
                <input type="file" class="form-control" id="picture3" name='picfile'>
              </div>
        </div>

        <!-- disorders added by user will appear below -->

        <input type='hidden' name='addedDisordersList' value='' id='hiddenData' />
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
          echo "<script> alert('File could not be uploaded'); </script>";
        }
        ?>
        <button class='btn btn-primary btn-md col-4 mx-auto disabled' id='addButton'>Add Specialist</button>
      </form>
    </div>
    <div style="width:30%; margin-left:auto; margin-right:auto; margin-bottom:20px;">
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

    //if you want better js code and one that makes sense, refer to the original at add_disorder_form.php

    function addSymptom(id) {
      var toAdd = document.getElementById(id).value;

      if (toAdd.length == 0)
        return;

      //loop through the list to check if the symptom is already added
      for (var i = 0; i < addedDisordersList.length; i++)
        if (addedDisordersList[i].disorder == toAdd)
          return;

      createRow(toAdd);
      addedDisordersList.push({
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

      document.getElementById('chooseSymptom').insertAdjacentElement("afterend", disorderInputDiv);
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

      if (document.getElementById('centerName3').value.length > 0 && document.getElementById('userEmail3').value.length > 0 && document.getElementById('userPassword').value.length > 0 && addedDisordersList.length > 0)
        document.getElementById('addButton').classList.remove('disabled');
      else
        document.getElementById('addButton').classList.add('disabled');
    }

    function checkSubmitability() {
      if (document.getElementById('centerName3').value.length > 0 && document.getElementById('userEmail3').value.length > 0 && document.getElementById('userPassword').value.length > 0 && addedDisordersList.length > 0) {
        if (confirm("Are you sure you want to add this specialist?"))
          return true;
        else
          return false;
      } else
        return false;
    }
  </script>


</body>

</html>