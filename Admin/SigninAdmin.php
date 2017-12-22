<?php


  include_once('../dbconnect.php');


  $error = false;
  if(isset($_POST['signup-btn']))
  {
    $adminid = trim($_POST['adminid']);
    $adminid = htmlspecialchars(strip_tags($adminid));

    $password = trim($_POST['pwd']);
    $password = htmlspecialchars(strip_tags($password));

    if(empty($adminid))
    {
      $error = true;
      $erroradminid = 'Please enter Adminid';
    }
    if(empty($password))
    {
      $error = true;
      $errorpassword = 'Please enter password';
    }
    elseif (strlen($password)<5)
    {
      $error = true;
      $errorpassword = 'Please enter more than 5 characters';
    }

    if(!$error)
    {

      $sql = "SELECT * FROM Admindb WHERE adminid='$adminid'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      $row =  mysqli_fetch_assoc($result);

      if($count == 1 && $row['pwd'] ==$password)
      {
        session_start();
        $_SESSION['adminid'] = $row['adminid'];
        header('location: Admindashboard.php');
      }
      else {
        echo 'Error'.mysqli_error($conn);
        $errormeg = 'INVALID userid or Password';
      }
    }
  }
 ?>

<html>
  <head>
    <title>login page</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css"/>
  </head>
  <body background = "../assets/bluebackground.jpg">
      <div class="container">
        <div style="width:300px; margin:100px auto;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ?>" autocomplete="off">
            <center><h3>Login</h3></center>
            <hr/>
            <?php
              if(isset($errormeg))
              {
                ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <?php echo $errormeg; ?>
                </div>
                <?php
              }
             ?>
            <div class="form--group">
              <input placeholder="Admin_id" type="text" name="adminid" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($erroradminid)) echo $erroradminid; ?></span>
            </div>
            <br>
            <div class="form-group">
              <input placeholder="Password" type="password" name="pwd" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorpassword)) echo $errorpassword; ?></span>
            </div>
            <div class="form-group">
              <center><input type="submit" value="signin" name="signup-btn" class="btn btn-primary"></center>
              <center><h4>Go to Home?<a href="../home.php">HOME</a></h4></center>
            </div>
          </form>
        </div>
      </div>
  </body>
</html>
