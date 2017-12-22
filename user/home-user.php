<?php


session_start();

 ?>

<html>
  <head>
    <title>home page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  </head>
  <body background = "../assets/bluebackground.jpg" style="background-repeat: no-repeat;">
      <div class="container">
        <div style="width:300px; margin:100px auto;">
          <h1>WELCOME
              <?php
                    echo

                    $_SESSION['uid'];
               ?>



          </h1>
        </div>
      </div>
  </body>
</html>
