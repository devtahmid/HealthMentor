<?php
session_start();
if (!isset($_SESSION['userId']))
  header('Location: login.php?error=Need to log in');
$sid = $_SESSION['userId'];
try {
  require('project_connection.php');
  $userResult = $db->prepare("SELECT * FROM users WHERE id= :id");
  $userResult->bindParam(':id', $sid);
  $userResult->execute();
  $userRow = $userResult->fetch();
  $password = $userRow['password'];
  $name = $userRow['name'];
  $email = $userRow['email'];
  $profile_pic = $userRow['profile_pic'];
  $db = null;
} catch (PDOException $e) {
  echo "<script>alert('Error " . $e->getMessage() . "\\nPlease refresh');</script>"; //paste in b/w ".$e->getMessage()."  to see errror

}
?>


<!doctype html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-control {
      font-size: 18px;
      font-weight: bolder;
    }

    .form-control::placeholder {
      font-weight: 20;
    }

    .profile-picSizeOverride {
      max-width: 300px !important;
      max-height: 300px !important;
    }
  </style>
</head>

<body>
  <?php
  if ($_SESSION['userType'] == "member")
    require('navbar_member.php');
  else if ($_SESSION['userType'] == "admin")
    require('navbar_admin.php');
  ?>
  <br /><br /> <br />
  <div class="container">
    <main class="form-signin w-100 m-auto">
      <div class="border border-secondary border-2 rounded">
        <form id='profileForm' onSubmit="return checkeditedInputs();" action='updateProfile.php' method='post' class="m-4" enctype="multipart/form-data">
          <h1 class="h3 mb-3 fw-normal text-center">Profile</h1>

          <div class="mx-auto text-center">
            <img src='./uploadedimages/<?php echo $profile_pic; ?>' class='profile-pic img-fluid border border-secondary border-2 rounded profile-picSizeOverride' alt='profilepic'>
          </div>
          <input type="file" name="picfile" id='fileUpload' /><span> (images<=5MB) </span><br><br>

              <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input class='form-control' type='text' name='name' id="name" placeholder="maximum 50 characters" onkeyup="checkFN(this.value, 'name_msg')" size='50' value='<?php echo htmlspecialchars("$name"); ?>' required><span id='name_msg'></span>
              </div>

              <div class="mb-2">
                <label for="exampleInputEmail1" class="form-label">Email address</label>

                <input type="email" class="form-control" name="email" value='<?php echo htmlspecialchars("$email"); ?>' id="exampleInputEmail1" placeholder="name@petshop.com" size='20' readonly>
                <span id='mail_msg'></span>

              </div>

              <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name='password' onkeyup="checkPWD(this.value)">
                <div id="profile_pwd_msg" class="form-text">min 6 char, 1 uppercase, 1 lowercase, 1 number</div>
              </div>

              <div>
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name='cnfm_password' onkeyup="confirmPWD(this.value)">
                <div id="cfmpwd_msg" class="form-text"></div>
              </div>

              <input type='hidden' name='JSEnabled' value='false'>
              <input class="w-100 btn btn-lg btn-primary mt-2" type='submit' name='edit_user' value='Edit'>
        </form>
      </div>
    </main>
  </div>
  <?php

  $error = null;
  extract($_GET);
  if ($error == 1) {
    echo "<script> alert('File could not be uploaded'); </script>";
  } elseif ($error == 2) {
    echo "<script> alert('Please enter valid inputs, perhaps turn on client side scripting'); </script>";
  } elseif ($error == 3) {
    echo "<script> alert('nothing updated'); </script>";
  }
  ?>
</body>
<script>
  <?php
  /*  echo "var name=\"" . $name . "\";\n";
  echo "var email=\"" . $email . "\";\n"; */
  ?>

  var nameFlag = emailFlag = passwordFlag = cnfmpasswordFlag = fileUploadFlag = true; //true by default

  function checkFN(name1, id) { //check full name
    var nameExp = /^([a-z]{2,}\s)*[a-z]+$/i;
    if (name1.length == 0) {
      msg = "Enter name!";
      color = "red";
      nameFlag = false;
    } else if (!nameExp.test(name1)) {
      msg = "Invalid Name";
      color = "red";
      nameFlag = false;
    } else {
      msg = "Valid Name";
      color = "green";
      nameFlag = true;
    }
    document.getElementById(id).style.color = color;
    document.getElementById(id).innerHTML = msg;
  }


  function checkPWD(pwd) { //check password
    console.log(pwd);
    var pwdExp = /^[0-9A-Za-z]{5,16}$/;
    if (pwd.length == 0) {
      msg = ""; //accepted to retain original values
      color = "red";
      passwordFlag = true;
    } else if (!pwdExp.test(pwd)) {
      msg = "Invalid password";
      color = "red";
      passwordFlag = false;
    } else {
      msg = "Valid password";
      color = "green";
      passwordFlag = true;
    }
    document.getElementById('profile_pwd_msg').style.color = color;
    document.getElementById('profile_pwd_msg').innerHTML = msg;
    confirmPWD(document.getElementById('profileForm').cnfm_password.value);
  }

  function confirmPWD(cpassword) { //check 2nd password
    if ((cpassword.length == 0) && (document.getElementById('profileForm').password.value.length == 0)) { //both passwords empty
      msg = "";
      cnfmpasswordFlag = true;
    } else if (cpassword.length == 0) { //confirmpassword empty but firstpassword not empty
      msg = "";
      cnfmpasswordFlag = false;
    } else if (document.getElementById('cfmpwd_msg').innerHTML == 'Invalid password') { //typing confirm password but first password is not valid
      msg = "enter valid password first";
      color = "red";
      cnfmpasswordFlag = false;
    } else { //cpassword not empty and firstpassword is valid
      var firstPwd = document.getElementById('profileForm').password.value;

      if (firstPwd.length == 0) {
        msg = "";
        cnfmpasswordFlag = false;
        color = "white"; //need to enter or gives not defined error
      } else if (cpassword != firstPwd) {
        msg = "passwords don't match";
        color = "red";
        cnfmpasswordFlag = false;

      } else {
        msg = "they match";
        color = "green";
        cnfmpasswordFlag = true;
      }
    }
    document.getElementById('cfmpwd_msg').style.color = color;
    document.getElementById('cfmpwd_msg').innerHTML = msg;
  }


  function checkeditedInputs() {
    document.getElementById('profileForm').JSEnabled.value = "TRUE";
    return (nameFlag && emailFlag && passwordFlag && cnfmpasswordFlag);
  }
</script>

</html>