<?php
session_start();
if(!isset($_SESSION['uid']))
{
  header("location:signin-user.php");
}
else
{
  include_once('../dbconnect.php');

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editing the user details</title>
      <link rel="stylesheet" href="../assets/style.css"/>
  </head>
  <body background = "../assets/bluebackground.jpg">

    <ul>
      <li><a href="#" style="hover:not ;background-color: #0a3e91;">
        <?php echo $_SESSION['uid']; ?><br>
        DASHBOARD</a></li>
      <li><a href="../user/userDashboard.php">HOME</a></li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="menubar-dropdown">MENU ▼</a>
        <div class="dropdown-content">
          <a href="userBorrowbook.php">Borrow Book(s)</a>
          <a href="userReturnbook.php">Return Book(s)</a>
          <a href="userReissuebook.php">Reissue Book(s)</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="bookbar-dropdown">BOOK ▼</a>
        <div class="dropdown-content">
          <a href="userListbook.php">List of Book(s)</a>
          <a href="userListofborrowedbooks.php">Borrowed Books</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="users-dropdown">USERS ▼</a>
        <div class="dropdown-content">
          <a href="userBorrowOverdue.php">User Fine</a>
        </div>
      </li>
      <li><a href="userSearchbook.php">Search(Books)</a></li>
      <li><a href="userLogout.php">LOG OUT</a></li>
    </ul>


    <center>
    <p><h3>List of Books</h3></p>
    <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
      <tr>
        <th>No</th>
        <th>Name of Book</th>
        <th>Author</th>
        <th>category</th>
        <th>Book code</th>
        <th>Price</th>
        <th>Publisher</th>
        <th>Total Books</th>
        <th>Rack Number</th>
      </tr>
      <?php

        $sql = "SELECT * FROM newbook";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {
          $i = 1;
          while ($row = mysqli_fetch_object($query))
          {
      ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row->booknm; ?></td>
            <td><?php echo $row->bauthor; ?></td>
            <td><?php echo $row->category; ?></td>
            <td><?php echo $row->bcode; ?></td>
            <td><?php echo $row->bprice; ?></td>
            <td><?php echo $row->bpublisher; ?></td>
            <td><?php echo $row->totbooks; ?></td>
            <td><?php echo $row->racknum; ?></td>
          </tr>

      <?php
          }
        }

       ?>
    </table>
  </center>
  </body>
</html>
<?php } ?>
