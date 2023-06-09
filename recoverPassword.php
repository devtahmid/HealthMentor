<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title> </title>

  <head>
    <meta charset="UTF-8">
    <title>AnimaForm</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
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
    <h1 class="section-title"> </h1>
    <div class="forms">
      <div class="form-wrapper is-active">
        <button type="button" class="switcher switcher-login">
          Verify using Security question
          <span class="underline"></span>
        </button>
        <form class="form form-login" method='post' action="processRecoverPassword.php">
          <fieldset>
            <legend>Please, enter your email and password for login.</legend>
            <div class="input-block">
              <label for="login-email">E-mail</label>
              <input id="login-email" type="email" name="email" onkeyup="checkMAIL(this.value, 'loginemail')" placeholder="Email Address" required>
              <span id='loginemail'></span>
            </div>

            <div class="input-block">
              <label for="signup-password-confirm">Select your security prompt</label>
              <select name="security_question" id="security_question" required>
                <option value="What's your pet's name?">What's your pet's name?</option>
                <option value="Where were you born?">Where were you born?</option>
                <option value="What's your nickname?">What's your nickname?</option>
              </select>
              <input id="signup-password-confirm" name='security_answer' onkeyup="verifySecurityAnswer(this.value)" required maxlength="30">
              <span id='security_msg'></span>
            </div>


          </fieldset>

          <input type='hidden' name='JSEnabled' value='false'>
          <input type="submit" name='submit' value="Recover" class="btn-login">
        </form>
      </div>

    </div>
  </section>
  <!-- partial -->
  <!--  <script src="./js/script.js"></script> -->

</body>

</html>