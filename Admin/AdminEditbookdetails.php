<?php
session_start();
if(!isset($_SESSION['adminid']))
{
  header("SigninAdmin.php");
}
else
{
  include_once('../dbconnect.php');

  $booknm = "0";
  $bauthor = "0";
  $category = "0";
  $bcode = "0";
  $bprice = "0";
  $bpublisher = "0";
  $totbooks = "0";
  $racknum = "0";


  if(isset($_POST['bookdetailsUpdate-btn']))
  {
    $booknm = $_POST['booknm'];
    $bauthor = $_POST['bauthor'];
    $category = $_POST['category'];
    $bcode = $_POST['bcode'];
    $bprice = $_POST['bprice'];
    $bpublisher = $_POST['bpublisher'];
    $totbooks = $_POST['totbooks'];
    $racknum = $_POST['racknum'];




    $sqlu = "UPDATE  newbook SET booknm='$_POST[booknm]', bauthor='$_POST[bauthor]', category='$_POST[category]', bcode='$_POST[bcode]',
            bprice='$_POST[bprice]', bpublisher='$_POST[bpublisher]', totbooks='$_POST[totbooks]', racknum='$_POST[racknum]'
            WHERE bcode='$_POST[bcode]'";
    mysqli_query($conn,$sqlu);

            if(mysqli_query($conn, $sqlu))
            {
              $successmez = 'Details Updated successfully.';
            }
            else
              {
                echo 'Error'.mysqli_error($conn);
              }

 };


    if(isset($_GET['edit']))
    {

      $sql = "SELECT * FROM newbook WHERE bcode='{$_GET['bcode']}'";
      $query = mysqli_query($conn,$sql);
      $row = mysqli_fetch_object($query);
      $booknm = $row->booknm;
      $bauthor = $row->bauthor;
      $bcode = $row->bcode;
      $category = $row->category;
      $bprice = $row->bprice;
      $bpublisher = $row->bpublisher;
      $totbooks = $row->totbooks;
      $racknum = $row->racknum;
    }

    if(isset($_GET['delete']))
    {
      $sql = "SELECT * FROM newbook WHERE bcode='{$_GET['bcode']}'";
      $query = mysqli_query($conn,$sql);
      $row = mysqli_fetch_object($query);
      $booknm = $row->booknm;
      $bauthor = $row->bauthor;
      $bcode = $row->bcode;
      $category = $row->category;
      $bprice = $row->bprice;
      $bpublisher = $row->bpublisher;
      $totbooks = $row->totbooks;
      $racknum = $row->racknum;

      $sql = "DELETE FROM newbook WHERE bcode='{$_GET['bcode']}'";
      $query = mysqli_query($conn,$sql);
      if($query)
      {
        header('Refresh:0; Adminsearchbook.php');
      }
    }
 ?>
<html>
  <head>
      <title>Add details of new book(add)</title>
      <link rel="stylesheet" href="../assets/style.css"/>
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
          <a href="Adduser.php">Add User</a>
          <a href="../user/Listuser.php">List of Users</a>
          <a href="../book/BorrowOverdue.php">User Fine</a>
        </div>
      </li>
      <li><a href="Adminsearchbook.php">Search(Books)</a></li>
      <li><a href="AdminLogout.php">LOG OUT</a></li>
    </ul>

    <div class="container">
      <div style="width:300px; margin:30px auto;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <center><h3>Edit Details of the book</h3></center>
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
            <input placeholder="Name of Book" type="text" name="booknm" value="<?php echo $booknm; ?>" class="form-control" autocomplete="off">
            </div>
          <br>
          <div class="form--group">
            <input placeholder="Author of the book" type="text" name="bauthor" value="<?php echo $bauthor; ?>" class="form-control" autocomplete="off">
          </div>
          <div class="form--group">
          <h4>Category</h4>
              <select name="category"  class="form-control">
                <option <?php if($category=='Course') echo 'selected'; ?> value="Course">Course</option>
                <option  <?php if($category=='Story') echo 'selected'; ?> value="Story">Story</option>
                <option  <?php if($category=='Magazines') echo 'selected'; ?> value="Magazines">Magazines</option>
                <option  <?php if($category=='Novels') echo 'selected'; ?> value="Novels">Novels</option>
                <option  <?php if($category=='Others') echo 'selected'; ?> value="Others">Others</option>
              </select>
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Book Code" type="text" name="bcode" class="form-control" value="<?php echo $bcode; ?>" autocomplete="off">
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Price" type="number" name="bprice" class="form-control" value="<?php echo $bprice; ?>" autocomplete="off">
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Publisher" type="text" name="bpublisher" class="form-control"  value="<?php echo $bpublisher; ?>" autocomplete="off">
            </div>
          <br>
          <div class="form--group">
            <input placeholder="Total Books" type="number" name="totbooks" class="form-control"  value="<?php echo $totbooks; ?>" autocomplete="off">
          </div>
          <br>
          <div class="form--group">
            <input placeholder="Rack Number" type="text" name="racknum" class="form-control"  value="<?php echo $racknum; ?>" autocomplete="off">
          </div>
          <br>
          <div class="form--group" >
              <center><input type="Submit" value="Submit Details" name="bookdetailsUpdate-btn" class="btn btn-primary"></center>


          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
  }
 ?>
