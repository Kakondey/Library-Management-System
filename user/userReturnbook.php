<?php
session_start();
if(!isset($_SESSION['uid']))
{
  header("Signin-user.php");
}
else
{
    include_once('../dbconnect.php');

    if(isset($_GET['return']))
    {


      $borrowstatus = "returned";

      $sqlu = "UPDATE borrower SET borrowstatus='$borrowstatus' WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
      mysqli_query($conn, $sqlu);


      $queryreissue = "UPDATE reissue_finelist SET borrowstatus='$borrowstatus' WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
      mysqli_query($conn, $queryreissue);
      header('Refresh:0; userReturnbook.php');
    }


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Return Book.</title>
    <link rel="stylesheet" href="../assets/style.css">
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
      <p><h3>Details of Books borrowed</h3></p>
    <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
      <tr>
        <th>Borrow Date</th>
        <th>Return Date</th>
        <th>Name of Book</th>
        <th>Author</th>
        <th>category</th>
        <th>Book code</th>
        <th>Price</th>
        <th>Publisher</th>
        <th>Rack Number</th>
        <th>No. of days Left to Return</th>
        <th>Borrow Status</th>
        <th>Action</th>
      </tr>
      <?php

        $sql = "SELECT * FROM borrower WHERE borrowstatus='pending' AND uid ='".$_SESSION['uid']."'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {

          while ($row = mysqli_fetch_object($query))
          {

            $returndate = $row->returndate;
            $datetoday = date("Y-m-d");
            $returndate = date("Y-m-d", strtotime($returndate));
            $diff = abs(strtotime($returndate) - strtotime($datetoday));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $returndaysleftchange = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


            ?>
          <tr>
            <td><?php echo $row->borrowdate; ?></td>
            <td><?php echo $row->returndate; ?></td>
            <td><?php echo $row->booknm; ?></td>
            <td><?php echo $row->bauthor; ?></td>
            <td><?php echo $row->category; ?></td>
            <td><?php echo $row->bcode; ?></td>
            <td><?php echo $row->bprice; ?></td>
            <td><?php echo $row->bpublisher; ?></td>
            <td><?php echo $row->racknum; ?></td>
            <td><?php echo $returndaysleftchange." days left to return"; ?></td>
            <td><?php echo $row->borrowstatus; ?></td>
            <td>
                <a href="userReturnbook.php?return=1&bcode=<?php echo $row->bcode; ?>&uid=<?php echo $row->uid; ?>"><input type="Submit" name="return" value="RETURN"></a>
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
