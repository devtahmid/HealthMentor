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


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
    Weglot.initialize({
      api_key: 'wg_a4e18a6b7b6b73066b2fb181dc6a5a109'
    });
  </script>
  <title>Games</title>
</head>

<body style="background-color: #e3f2fd;">


  <br /> <br />
  <br />

  <main class="container-md text-center">
    <div class="row">

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/jumpmath.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title"> Jump Math</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->


          <a class="btn btn-primary" href='https://demo.accesspoint.coop/jump_math/?gclid=Cj0KCQjwt_qgBhDFARIsABcDjOcuwu92n0wcGrYcLXpZgeiR-nWi075t6bontN3NZJzmF0UWI3ozxhsaAiJwEALw_wcB'>Play </a>

        </div>
      </div>

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/candytileblast.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">Candy Tile Blast</h3>
            <p class="card-text">
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->


          <a class="btn btn-primary" href='https://miminogames.com/arcade/candy-tile-blast/='>Play </a>

        </div>
      </div>

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/dailysolitaire.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">Daily Solitaire Blue</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->


          <a class="btn btn-primary" href='https://miminogames.com/puzzles/daily-solitaire-blue/'>Play </a>

        </div>
      </div>

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/cupswatersort.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">Cups Water Sort</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->


          <a class="btn btn-primary" href='https://www.crazygames.com/game/cups---water-sort-puzzle'>Play </a>

        </div>
      </div>


      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/2048merge.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">2048 Mege</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->
          <a class="btn btn-primary" href='https://www.crazygames.com/game/2048-merge'>Play </a>

        </div>
      </div>

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/nullify.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">Nullify</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->
          <a class="btn btn-primary" href="https://www.crazygames.com/game/nullify">Play</a>

        </div>
      </div>

      <div class="col mt-3">
        <div class="card" style="width: 18rem;">
          <img src="assets/braintrainer.png" style="height:175px;">
          <div class="card-body">
            <h3 class="card-title">Brain Trainer</h3>
            <p class="card-text">
              <br>
              <!-- <ul> -->

              <!-- </ul> -->
            </p>
          </div> <!-- end card body 1 -->
          <a class="btn btn-primary" href="https://www.crazygames.com/game/brain-trainer">Play</a>

        </div>
      </div>


    </div>
  </main>




</body>

</html>