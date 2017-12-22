<?php
session_start();
if(!isset($_SESSION['adminid']))
{
  header("SigninAdmin.php");
}
else
{
  include_once('../dbconnect.php');

  $error = "0";
  $firstname = "0";
  $lastname = "0";
  $userid = "0";
  $rollno = "0";
  $age = "0";
  $class = "0";
  $section = "0";
  $password = "0";
  $Cpassword = "0";


  if(isset($_POST['UserDetailsUpdate-btn']))
  {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $userid = $_POST['uid'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $password = $_POST['pwd'];
    $Cpassword = $_POST['Cpwd'];



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


    //UPDATE  data if no error...
    if(!$error)
    {
      $password = md5($password);
      $sqlu = "UPDATE newuserdata SET firstname='$_POST[firstname]', lastname='$_POST[lastname]', uid='$_POST[uid]', rollno='$_POST[rollno]',
              age='$_POST[age]', class='$_POST[class]', section='$_POST[section]', pwd='$_POST[pwd]', Cpwd='$_POST[Cpwd]'
              WHERE uid='$_POST[uid]'";

      mysqli_query($conn,$sqlu);

              if(mysqli_query($conn, $sqlu))
              {
                $successmez = 'Details successfully Updated.';

              }
              else {
                echo 'Error'.mysqli_error($conn);
              }
    }
  };


  if(isset($_GET['edit']))
  {
    $sql = "SELECT * FROM newuserdata WHERE uid='{$_GET['uid']}'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_object($query);
    $firstname = $row->firstname;
    $lastname = $row->lastname;
    $userid = $row->uid;
    $rollno = $row->rollno;
    $age = $row->age;
    $class = $row->class;
    $section = $row->section;
    $password = $row->pwd;
    $Cpassword = $row->Cpwd;

  }

  if(isset($_GET['delete']))
  {
    $sql = "DELETE FROM newuserdata WHERE uid='{$_GET['uid']}'";
    $query = mysqli_query($conn,$sql);
    if($query)
    {
      header('Refresh:0; ../user/Listuser.php');
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

        <ul>
          <li><a href="#" style="hover:not ;background-color: #0a3e91;">DASHBOARD</a></li>
          <li><a href="../Admin/Admindashboard.php">HOME</a></li>
          <li class="dropdown">
            <a href="javascript:void(0)" class="menubar-dropdown">MENU ▼</a>
            <div class="dropdown-content">
              <a href="../book/Borrowbook.php">Borrow Book(s)</a>
              <a href="../book/returnbook.php">Return Book(s)</a>
              <a href="../book/Reissuebook.php">Reissue Book(s)</a>
            </div>
          </li>
          <li class="dropdown">
            <a href="javascript:void(0)" class="bookbar-dropdown">BOOK ▼</a>
            <div class="dropdown-content">
              <a href="../book/addnewbook.php">Add Books</a>
              <a href="../book/Listbook.php">List of Book(s)</a>
              <a href="../book/Listofborrowedbooks.php">Borrowed Books</a>
            </div>
          </li>
          <li class="dropdown">
            <a href="javascript:void(0)" class="users-dropdown">USERS ▼</a>
            <div class="dropdown-content">
              <a href="../user/signup.php?adduser=1">Add Users</a>
              <a href="../user/Edituser.php">Edit Users</a>
              <a href="../book/BorrowOverdue.php">User Fine</a>
            </div>
          </li>
          <li><a href="Adminsearchbook.php">Search(Books)</a></li>
          <li><a href="AdminLogout.php">LOG OUT</a></li>
        </ul>


      <div class="container">
        <div style="width:300px; margin:30px auto;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

              <center><h3>Edit User Details.</h3></center>

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
              <input placeholder="firstname" type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorfirstname)) echo $errorfirstname; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="lastname" type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorlastname)) echo $errorlastname; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="User_id" type="text" name="uid" class="form-control" value="<?php echo $userid; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($erroruserid)) echo $erroruserid; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="rollno" type="number" name="rollno" class="form-control" value="<?php echo $rollno; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorrollno)) echo $errorrollno; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="age" type="number" name="age" class="form-control" value="<?php echo $age; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorage)) echo $errorage; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="class" type="number" name="class" class="form-control" value="<?php echo $class; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorclass)) echo $errorclass; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="section" type="text" name="section" class="form-control" value="<?php echo $section; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorsection)) echo $errorsection; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="Password" type="password" name="pwd" class="form-control" value="<?php echo $pwd; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorpassword)) echo $errorpassword; ?></span>
            </div>
            <br>
            <div class="form--group">
              <input placeholder="Confirm Password" type="password" name="Cpwd" class="form-control" value="<?php echo $Cpwd; ?>" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorCpassword)) echo $errorCpassword; ?></span>
            </div>
            <br>
            <div class="form--group">
              <center><input type="submit" value="Update Details" name="UserDetailsUpdate-btn" class="btn btn-primary"></center>
            </div>
          </form>
        </div>
      </div>
  </body>
</html>
<?php
  }
 ?>
