<?php
session_start();
if(!isset($_SESSION['adminid']))
{
  header("SigninAdmin.php");
}
else
{
    include_once('../dbconnect.php');

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>List of Borrowed Books.</title>
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
          <a href="Reissuebook.php">Reissue Book(s)</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="bookbar-dropdown">BOOK ▼</a>
        <div class="dropdown-content">
          <a href="../book/addnewbook.php">Add Books</a>
          <a href="Listbook.php">List of Book(s)</a>
          <a href="Listofborrowedbooks.php">List of Borrowed Books</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="users-dropdown">USERS ▼</a>
        <div class="dropdown-content">
          <a href="../Admin/Adduser.php">Add Users</a>
          <a href="../user/Listuser.php">List of Users</a>
          <a href="BorrowOverdue.php">User Fine</a>
        </div>
      </li>
      <li><a href="../Admin/Adminsearchbook.php">Search(Books)</a></li>
      <li><a href="../Admin/AdminLogout.php">LOG OUT</a></li>
    </ul>

    <center>
      <p><h3>LIST OF BORROWED BOOKS</h3></p>
    <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
      <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
        <th>Name of Book</th>
        <th>Author</th>
        <th>category</th>
        <th>Book code</th>
        <th>Price</th>
        <th>Publisher</th>
        <th>Rack Number</th>
        <th>Borrow Status</th>
        <th>Reissue Status</th>
        <th>OverDue Status</th>
      </tr>
      <?php

        $sql = "SELECT * FROM borrower";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {

          while ($row = mysqli_fetch_object($query))
          {
            $uid = $row->uid;
            $bcode = $row->bcode;
            $sqlI = "SELECT * FROM reissue_finelist WHERE uid ='$uid' AND bcode ='$bcode'";
            $queryI = mysqli_query($conn,$sqlI);
            $rowI = mysqli_fetch_object($queryI);
            $fine = $rowI->fine;
      ?>
          <tr>
            <td><?php echo $row->uid; ?></td>
            <td><?php echo $row->firstname; ?></td>
            <td><?php echo $row->lastname; ?></td>
            <td><?php echo $row->borrowdate; ?></td>
            <td><?php echo $row->returndate; ?></td>
            <td><?php echo $row->booknm; ?></td>
            <td><?php echo $row->bauthor; ?></td>
            <td><?php echo $row->category; ?></td>
            <td><?php echo $row->bcode; ?></td>
            <td><?php echo $row->bprice; ?></td>
            <td><?php echo $row->bpublisher; ?></td>
            <td><?php echo $row->racknum; ?></td>
            <td><?php echo $row->borrowstatus; ?></td>
            <td><?php echo $rowI->reissueStatus; ?></td>
            <td><?php if($fine == 1)
            {
              echo "Fine Charged";
            }
            else
            {
              echo "Fine not charged";
            }
             ?>
           </td>
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
