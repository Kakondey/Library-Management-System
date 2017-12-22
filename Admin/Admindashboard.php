<?php

  session_start();
  if(!isset($_SESSION['adminid']))
  {
    header("location:SigninAdmin.php");
  }
  else
  {
    include_once('../dbconnect.php');
   ?>
   <!DOCTYPE html>
  <html>
    <head>
        <title>admin dashboard</title>
        <link rel="stylesheet" href="../assets/style.css"/>
    </head>
    <body style="margin: 0px;" background = "../assets/bluebackground.jpg">
      <ul>
        <li><a href="#" style="hover:not ;background-color: #0a3e91;">
          <?php echo $_SESSION['adminid']; ?><br>
          DASHBOARD</a></li>
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

          </body>
  </html>
<?php
}
 ?>
