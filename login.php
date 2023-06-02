<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title> </title>

  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  </head>
  <link rel="stylesheet" href="./css/login.css">
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <script src="js/reg_loginformvalidation.js"> </script>

</head>

<body>
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
    require('navbar_guest2.php');
  ?>
  <!-- partial:index.partial.html -->
  <section class="forms-section">
    <h1 class="section-title">Login / Sign-Up </h1>
    <div class="forms">
      <div class="form-wrapper is-active">
        <button type="button" class="switcher switcher-login">
          Login
          <span class="underline"></span>
        </button>
        <form class="form form-login" method='post' action="credentialController.php" onSubmit="return checkLoginInputs();">
          <fieldset>
            <legend>Please, enter your email and password for login.</legend>
            <div class="input-block">
              <label for="login-email">E-mail</label>
              <input id="login-email" type="email" name="email" onkeyup="checkMAIL(this.value, 'loginemail')" placeholder="Email Address" required value="<?php if (isset($_GET['fillemail'])) echo $_GET['fillemail']; ?>">
              <span id='loginemail'></span>
            </div>
            <div class="input-block">
              <label for="login-password">Password</label>
              <input id="login-password" name="password" onkeyup="checkPWD(this.value,'login_pwd_msg')" type="password" placeholder="Password" required value="<?php if (isset($_GET['fillpwd'])) echo $_GET['fillpwd']; ?>">
              <div id="login_pwd_msg" class="form-text">5-16 alphanumeric characters</div>
            </div>
            <div class="signup-link" style="color:red;">
              <?php

              if (isset($_GET['error'])) {
                echo $_GET['error'];
              }
              ?>
            </div>
          </fieldset>
          <a href="recoverPassword.php">Forgot password?</a>
          <input type='hidden' name='JSEnabled' value='false'>
          <input type='hidden' name='hiddenSubmit' value='Login'> <!-- becayse weglot was translating the value but the correct value is needed in controller -->
          <input type="submit" name='submit' value="Login" class="btn-login">
          <input type="submit" value="Sample Credentials" style="padding:0px 10px;" class="btn-login" onclick="return displaySampleCredentials()">
        </form>
      </div>
      <div class="form-wrapper">
        <button type="button" class="switcher switcher-signup">
          Sign Up
          <span class="underline"></span>
        </button>
        <form class="form form-signup" method='post' action="credentialController.php" onSubmit="return checkRegistrationInputs();">
          <fieldset>
            <legend>Please, enter your name, email, password and password confirmation for sign up.</legend>
            <div class="input-block">
              <label for="signup-name">Name</label>
              <input id="signup-name" name='name' onkeyup="checkFN(this.value)" type="text" required>
              <span id='name_msg'></span>
            </div>
            <div class="input-block">
              <label for="signup-email">E-mail</label>
              <input id="signup-email" name='email' type="email" onkeyup="checkMAIL(this.value, 'registrationemail')" required>
              <span id='registrationemail'></span>
            </div>
            <div class="input-block">
              <label for="signup-password">Password</label>
              <input id="signup-password" name='password' type="password" onkeyup="checkPWD(this.value,'reg_pwd_msg')" required>
              <span id='reg_pwd_msg'></span>
            </div>

            <div class="input-block">
              <label for="signup-password-confirm">Confirm password</label>
              <input id="signup-password-confirm" type="password" name='confirm_password' onkeyup="confirmPWD(this.value)" required>
              <span id='cfmpwd_msg'></span>
            </div>

            <div class="input-block">
              <label for="signup-password-confirm">Select security prompt</label>
              <select name="security_question" id="security_question" required>
                <option value="What's your pet's name?">What's your pet's name?</option>
                <option value="Where were you born?">Where were you born?</option>
                <option value="What's your nickname?">What's your nickname?</option>
              </select>
              <input id="signup-password-confirm" type="password" name='security_answer' onkeyup="verifySecurityAnswer(this.value)" required maxlength="30">
              <span id='security_msg'></span>
            </div>


            <input type='hidden' name='JSEnabled' value='false'>
          </fieldset>
          <?php
          if (isset($error2))
            echo "<script>alert('" . $error2 . "');</script>";
          ?>
          <input type='hidden' name='hiddenSubmit' value='Signup'>
          <input type="submit" name='submit' class="btn-signup" value="Signup">
        </form>
      </div>


      <!-- popup -->

      <div style="z-index:999; width:320px; height:335px;
		border:2px solid black; background:white;
  border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.40) 0px 42px 42px, rgba(0, 0, 0, 0.25) 0px 15px 15px; position:absolute; top:40%; left:45%; right:50%;  transform: translate(-50%, -50%); padding:3px; display:none;" id="credentialsPopup">

        <span style="font-weight:bolder;">Sample Credentials</span>
        <span style="font-weight:bolder; color:#1a1f71; padding:5px; margin-left:115px; cursor:pointer;" id='popupClose'>X</span>
        <hr style="background-color:#1a1f71; height:2px; border:none;">
        <u>Member</u>
        <p>Email:&emsp;&emsp; &nbsp; maximus1@gmail.com <br>
          Password: &nbsp; Max12345</p><br>
        <u>Admin</u>
        <p>Email:&emsp;&emsp; &nbsp; admin@admin.com <br>
          Password: &nbsp; admin</p><br>
        <u>Specialist</u>
        <p>Email:&emsp;&emsp; &nbsp; karenclapper@pm.com <br>
          Password: &nbsp; karenclapper</p>
      </div>
      <!-- popup js -->
      <script>
        document.getElementById('popupClose').addEventListener('click', displaySampleCredentials);

        function displaySampleCredentials() {
          if (document.getElementById('credentialsPopup').style.display == 'none')
            document.getElementById('credentialsPopup').style.display = 'block';
          else
            document.getElementById('credentialsPopup').style.display = 'none'

          return false; //because a submit button calling it
        }
      </script>



    </div>
  </section>
  <!-- partial -->
  <script src="./js/script.js"></script>

</body>

</html>