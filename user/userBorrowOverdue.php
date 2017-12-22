<?php
session_start();
if(!isset($_SESSION['uid']))
{
  header("Signin-user.php");
}
else
{
  include_once('../dbconnect.php');

  $error = "";
  $totdays = "";
  $paidtxt = "";


  if(isset($_GET['chargefine']))
  {
    $sql = "SELECT * FROM reissue_finelist WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_object($query);
    $fine = $row->fine;

    $fine = 1;
    $sqlu = "UPDATE reissue_finelist SET fine='$fine' WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
    mysqli_query($conn, $sqlu);
    header('Refresh:0; Reissuebook.php');

    echo "<script>
    alert('Fine has been paid.')
    window.location.href='userBorrowOverdue.php';
    </script>
    ";

    $paidtxt = "(Paid)";
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Borrow OverDue</title>
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
      <p><h3>User Overdue List</h3></p>
    <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
      <tr>
        <th>Book code</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
        <th>Borrow Status</th>
        <th>Reissue Status</th>
        <th>No. of days Left to Return</th>
        <th>Reissue Date</th>
        <th>Due Amount</th>
        <th>Action</th>
      </tr>
      <?php


        $sql = "SELECT * FROM reissue_finelist WHERE fine = 0 AND uid ='".$_SESSION['uid']."'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {

          while ($row = mysqli_fetch_object($query))
          {

            $returndate = $row->returndate;
            $datetoday = date("Y-m-d");
            $diff = abs(strtotime($returndate) - strtotime($datetoday));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $totdays = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $returndaysleftchange = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $fine = $totdays * 0.50;

            $reissuedate = $row->reissuedate;
            $reissuedateEnd = date('Y-m-d', strtotime($reissuedate. '+ 7 days'));
       ?>

          <tr>
            <td><?php echo $row->bcode; ?></td>
            <td><?php echo $row->borrowdate; ?></td>
            <td><?php echo $row->returndate; ?></td>
            <td><?php echo $row->borrowstatus; ?></td>
            <td><?php echo $row->reissueStatus; ?></td>
            <td><?php if($returndate < $datetoday)
            {
              echo "Return date already passed.";
            }
            else
            {
              echo $returndaysleftchange." days left to return";
            }
               ?></td>
            <td><?php echo $row->reissuedate; ?></td>
            <td><?php

            if($returndate < $datetoday)
            {
              echo $fine." Rs";
            }
            elseif ($reissuedateEnd < $datetoday && $reissuedate != "0000-00-00")
            {
              echo $fine." Rs";
            }
            else
            {
                echo "No Due yet.";
            }

             ?></td>
            <td>
              <a href="userBorrowOverdue.php?chargefine=1&bcode=<?php echo $row->bcode; ?>&uid=<?php echo $row->uid; ?>"><input type="Submit" name="chargefine" value="PAY FINE"></a>
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
