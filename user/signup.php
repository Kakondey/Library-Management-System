<?php
  include_once('../dbconnect.php');

  $error = false;

  if(isset($_POST['signup-btn']))
  {
    //clean user input to prevent sql injection...
    $firstname = $_POST['firstname'];
    $firstname = strip_tags($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = $_POST['lastname'];
    $lastname = strip_tags($lastname);
    $lastname = htmlspecialchars($lastname);

    $userid = $_POST['uid'];
    $userid = strip_tags($userid);
    $userid = htmlspecialchars($userid);

    $rollno = $_POST['rollno'];
    $rollno = strip_tags($rollno);
    $rollno = htmlspecialchars($rollno);

    $age = $_POST['age'];
    $age = strip_tags($age);
    $age = htmlspecialchars($age);

    $class = $_POST['class'];
    $class = strip_tags($class);
    $class = htmlspecialchars($class);

    $section = $_POST['section'];
    $section = strip_tags($section);
    $section = htmlspecialchars($section);

    $password = $_POST['pwd'];
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $Cpassword = $_POST['Cpwd'];
    $Cpassword = strip_tags($Cpassword);
    $Cpassword = htmlspecialchars($Cpassword);
  }

    //validate the data.......
    if(empty($firstname))
    {
      $error = true;
      $errorfirstname = 'please input valid firstname';
    }
    if(empty($lastname))
    {
      $error = true;
      $errorlastname = 'please input valid lastname';
    }
    if(empty($userid))
    {
      $error = true;
      $erroruserid = 'please input valid userid';
    }
    if(empty($rollno))
    {
      $error = true;
      $errorrollno = 'please input valid rollno';
    }
    if(empty($age))
    {
      $error = true;
      $errorage = 'please input valid age';
    }
    if(empty($class))
    {
      $error = true;
      $errorclass = 'please input valid class';
    }
    if(empty($section))
    {
      $error = true;
      $errorsection = 'please input valid section';
    }
    if(strlen($password)<5)
    {
      $error = true;
      $errorpassword = 'please input more than 8 characters';
    }
    if(empty($Cpassword))
    {
      $error = true;
      $errorCpassword = 'please input more than 8 characters';
    }
    elseif (strlen($Cpassword)<5)
    {
      $error = true;
      $errorCpassword = 'please input more than 8 characters';
    }
    elseif ($password != $Cpassword)
   {
      $error = true;
      $errorCpassword = 'please input same characters as above';
    }

    //encrypt password with md5...
    $password = md5($password);
    //$Cpassword = md5($Cpassword);

    //insert data if no error...
    if(!$error)
    {
      $sql = "INSERT INTO newuserdata(firstname, lastname, uid, rollno, age, class, section, pwd, Cpwd)
              VALUES('$firstname','$lastname','$userid','$rollno','$age','$class','$section','$password','$Cpassword')";


              if(mysqli_query($conn, $sql))
              {
                $successmez = 'Successfully registered.<a href="signin-user.php">click here to move to home.</a>';

              }
              else {
                echo 'Error'.mysqli_error($conn);
              }
    }

 ?>


<html>
  <head>
    <title>sign page</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css"/>
  </head>
  <body background = "../assets/bluebackground.jpg">

      <div class="container">
        <div style="width:300px; margin:30px auto;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

          <center><h3>Signup</h3></center>


            <hr/>
          <?php
            if(isset($successmez))
            {
              ?>
              <div class="alert alert-success">
                <span class="glyphicon glyphicon-info-sign"></span>
                <?php echo $successmez; ?>
              </div>
              <?php
            }
           ?>
            <div class="form--group">
              <input placeholder="firstname" type="text" name="firstname" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorfirstname)) echo $errorfirstname; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="lastname" type="text" name="lastname" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorlastname)) echo $errorlastname; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="User_id" type="text" name="uid" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($erroruserid)) echo $erroruserid; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="rollno" type="number" name="rollno" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorrollno)) echo $errorrollno; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="age" type="number" name="age" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorage)) echo $errorage; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="class" type="number" name="class" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorclass)) echo $errorclass; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="section" type="text" name="section" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorsection)) echo $errorsection; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="Password" type="password" name="pwd" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorpassword)) echo $errorpassword; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="Confirm Password" type="password" name="Cpwd" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorCpassword)) echo $errorCpassword; ?></span>
            </div>
            <br>
            <div class="form--group">
              <center><input type="submit" value="signup" name="signup-btn" class="btn btn-primary"></center>
            </div>
          </form>
        </div>
      </div>
  </body>
</html>
