<?php
session_start();
if(!isset($_SESSION['adminid']))
{
  header("SigninAdmin.php");
}
else
{
  include_once('../dbconnect.php');

  $error = false;

  if(isset($_POST['bookdetails-btn']))
  {
    $booknm = $_POST['booknm'];
    $bauthor = $_POST['bauthor'];
    $category = $_POST['category'];
    $bcode = $_POST['bcode'];
    $bprice = $_POST['bprice'];
    $bpublisher = $_POST['bpublisher'];
    $totbooks = $_POST['totbooks'];
    $racknum = $_POST['racknum'];
  }

  //validate the data...
  if(empty($booknm))
  {
    $error = true;
    $errorbooknm = 'Please insert name of the book';
  }
  if (empty($bauthor))
  {
    $error = true;
    $errorbauthor = 'Please insert the name of the author';
  }
  if(empty($bcode))
  {
    $error = true;
    $errorbcode = 'Please enter a valid book code';
  }
  if(empty($bprice))
  {
    $error = true;
    $errorbprice = 'Please insert the price of the book';
  }
  if(empty($bpublisher))
  {
    $error = true;
    $errorbpublisher = 'Please insert the Publisher of the book';
  }
  if(empty($totbooks))
  {
    $error = true;
    $errortotbooks = 'Please enter the total number of books';
  }
  if(empty($racknum))
  {
    $error = true;
    $errorracknum = 'Please enter the rack number';
  }

  //insert into database if no error.......
  if(!$error)
  {
    $sql = "INSERT INTO newbook(booknm, bauthor, category, bcode, bprice, bpublisher, totbooks, racknum)
            VALUES('$booknm','$bauthor','$category','$bcode','$bprice','$bpublisher','$totbooks','$racknum')";

            if(mysqli_query($conn, $sql))
            {
              $successmez = 'Details successfully entered.';
            }
            else
              {
                echo 'Error'.mysqli_error($conn);
              }
  }
 ?>
<html>
  <head>
      <link rel="stylesheet" href="../assets/style.css"/>
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  </head>
  <body>

      <ul>
        <li><a href="#" style="hover:not ;background-color: #0a3e91;">DASHBOARD</a></li>
        <li><a href="../Admin/Admindashboard.php">HOME</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="menubar-dropdown">MENU ▼</a>
          <div class="dropdown-content">
            <a href="../book/Borrowbook.php">Borrow Book(s)</a>
            <a href="../book/returnbook.php">Return Book(s)</a>
            <a href="Reissuebook.php">Reissue Book(s)</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="bookbar-dropdown">BOOK ▼</a>
          <div class="dropdown-content">
            <a href="../book/addnewbook.php">Add Books</a>
            <a href="Listbook.php">List of Book(s)</a>
            <a href="Listofborrowedbooks.php">Borrowed Books</a>

          </div>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="users-dropdown">USERS ▼</a>
          <div class="dropdown-content">
            <a href="../Admin/Adduser.php">Add User</a>
            <a href="../user/Listuser.php">List of Users</a>
            <a href="BorrowOverdue.php">User Fine</a>
          </div>
        </li>
        <li><a href="../Admin/Adminsearchbook.php">Search(Books)</a></li>
        <li><a href="../Admin/AdminLogout.php">LOG OUT</a></li>





    <div class="container">
      <div style="width:300px; margin:30px auto;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <center><h3>Add details of new book</h3></center>
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
            <input placeholder="Name of Book" type="text" name="booknm" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if(isset($errorbooknm)) echo $errorbooknm; ?></span>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Author of the book" type="text" name="bauthor" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errorbauthor)) echo $errorbauthor; ?></span>
          </div>
          <div class="form--group">
          <h4>Category</h4>
              <select name="category" class="form-control">
                <option value="Course" selected>Course</option>
                <option value="Story">Story</option>
                <option value="Magazines">Magazines</option>
                <option value="Novels">Novels</option>
                <option value="Others">Others</option>
              </select>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Book Code" type="text" name="bcode" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errorbcode)) echo $errorbcode; ?></span>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Price" type="number" name="bprice" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errorbprice)) echo $errorbprice; ?></span>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Publisher" type="text" name="bpublisher" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errorbpublisher)) echo $errorbpublisher; ?></span>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Total Books" type="number" name="totbooks" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errortotbooks)) echo $errortotbooks; ?></span>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Rack Number" type="text" name="racknum" class="form-control" autocomplete="off">
            <span class="text-danger"><?php if (isset($errorracknum)) echo $errorracknum; ?></span>
          </div>
          <br>
          <div class="form--group" >
            <center><input type="Submit" value="Submit Details" name="bookdetails-btn" class="btn btn-primary"></center>
          </div>
        </form>
      </div>
    </div>
  </ul>
  </body>
</html>
<?php } ?>
