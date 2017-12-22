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
    <title>List of Borrowed Books.</title>
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
        <th>Overdue Status</th>
      </tr>
      <?php

        $sql = "SELECT * FROM borrower WHERE uid ='".$_SESSION['uid']."'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {

          while ($row = mysqli_fetch_object($query))
          {
            $uid = $row->uid;
            $bcode = $row->bcode;
            $sqlI = "SELECT * FROM reissue_finelist WHERE bcode ='$bcode' AND uid ='".$_SESSION['uid']."' ";
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
            <td><?php

                if($fine == 1)
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
