<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/contact.css">
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <title></title>
</head>

<body style="background-color: #e3f2fd;">
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
  <div class="container">
    <div class="form-container">
      <div class="left-container">
        <div class="left-inner-container">
          <h2>Let's Chat</h2>
          <p>Whether you have a question, want to clear a confusion or simply want to connect.</p>
          <br>
          <p>Feel free to send us a message in the contact form</p>
        </div>
      </div>
      <div class="right-container">
        <div class="right-inner-container">
          <form action="handleContactForm.php">
            <h2 class="lg-view">Contact</h2>
            <h2 class="sm-view">Let's Chat</h2>
            <p>* Required</p>
            <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <input type="text" name="name" placeholder="Name *" required />
            <input type="email" name="email" placeholder="Email *" required />
            <input type="phone" name="phone" placeholder="Phone *" required />
            <textarea rows="4" name="message" placeholder="Message *" maxlength="499" required></textarea>
            <?php
            if (isset($_GET['msg'])) {
              echo "<p style='color:green; font-size:0.8rem;'>" . $_GET['msg'] . "</p>";
            }
            ?>
            <button>Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>