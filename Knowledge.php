<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/knowledge.css">
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <title>Knowledge Center</title>
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

  <main>
    <br>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <lord-icon src="https://cdn.lordicon.com/uiaaaqiz.json" trigger="loop" delay="2000" style="width:150px;height:150px">
    </lord-icon>
    <h1>Self-Health Care</h1>
  </main>
  <footer>
    <div class="slider">
      <input type="radio" name="testimonial" id="t-1">
      <input type="radio" name="testimonial" id="t-2">
      <input type="radio" name="testimonial" id="t-3" checked>
      <input type="radio" name="testimonial" id="t-4">
      <input type="radio" name="testimonial" id="t-5">
      <div class="testimonials">
        <label class="item" for="t-1">
          <a href="https://www.cdc.gov/ncbddd/adhd/features/not-just-adhd.html"><img src="src/adhd" alt="picture"></a>
          <p>"Learn more about how to help children who have an ADHD and other disorders "
          </p>
          <h2>-Featured Articles </h2>
        </label>
        <label class="item" for="t-2">
          <a href="https://www.cdc.gov/ncbddd/actearly/whyActEarly.html"><img src="src/autism.jpg" alt="picture"></a>
          <p>"Act early on developmental concerns to make a real difference for your child ."</p>
          <h2>-Featured Articles </h2>
        </label>
        <label class="item" for="t-3">
          <a href="https://newsinhealth.nih.gov/2016/03/understanding-anxiety-disorders"><img src="src/anxiety.jpg" alt="picture"></a>
          <p>"Understanding Anxiety Disorders When Panic, Fear, and Worries Overwhelm ."</p>
          <h2>-Featured Articles </h2>
        </label>
        <label class="item" for="t-4">
          <a href="https://www.nimh.nih.gov/health/publications/eating-disorders"><img src="src/food.jpg" alt="picture"></a>
          <p>"Understanding food diorder,Eating Disorders: About More Than Food."</p>
          <h2>-Featured Articles </h2>
        </label>
        <label class="item" for="t-5">
          <a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC7455053/"><img src="src/dyslexia.jpg" alt="picture"></a>
          <p>"Defining and understanding dyslexia: past, present and future"</p>
          <h2>-Featured Articles </h2>
        </label>
      </div>
      <div class="dots">
        <label for="t-1"></label>
        <label for="t-2"></label>
        <label for="t-3"></label>
        <label for="t-4"></label>
        <label for="t-5"></label>
      </div>
    </div>
  </footer>
</body>

</html>