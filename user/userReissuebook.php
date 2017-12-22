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

  $reissuedatelatr = date("Y-m-d");

  if(isset($_GET['reissue']))
  {
    $sql = "SELECT * FROM reissue_finelist WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_object($query);
    $borrowdate = $row->borrowdate;
    $reissuedate = $row->reissuedate;

    $diff = abs(strtotime($reissuedate) - strtotime($borrowdate));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $reissuedayscount = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if($reissuedayscount > 7)
      {
        $error = true;
        echo "<script>
        alert('Books can be Reissued within 7 days from the date of Borrow.')
        window.location.href='Reissuebook.php';
        </script>
        ";

      }


    $reissueStatus = "reissued(DONE)";

    if(!$error)
    {
      $sqlu = "UPDATE reissue_finelist SET reissueStatus='$reissueStatus', reissuedate='$reissuedatelatr' WHERE uid ='{$_GET['uid']}' AND bcode ='{$_GET['bcode']}'";
      mysqli_query($conn, $sqlu);
      header('Refresh:0; userReissuebook.php');
    }

  }


 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Reissue Book</title>
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
       <p><h3>Books to be Reissued</h3></p>
     <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
       <tr>
         <th>User ID</th>
         <th>Book code</th>
         <th>Borrow Date</th>
         <th>Return Date</th>
         <th>Borrow Status</th>
         <th>Reissue Status</th>
         <th>No. of days Left to Return</th>
         <th>Reissue Date</th>
         <th>Action</th>
       </tr>
       <?php
         $sql = "SELECT * FROM reissue_finelist WHERE borrowstatus='pending' AND reissueStatus='not reissued' AND uid ='".$_SESSION['uid']."'";
         $query = mysqli_query($conn,$sql);
         if(mysqli_num_rows($query)>0)
         {

           while ($row = mysqli_fetch_object($query))
           {
             $sqlI = "SELECT * FROM borrower WHERE borrowstatus='pending'";
             $queryI = mysqli_query($conn,$sqlI);
             $rowI = mysqli_fetch_object($queryI);

             $returndate = $rowI->returndate;
             $datetoday = date("Y-m-d");

             $returndate = "";
             $returndate = date("Y-m-d", strtotime($returndate));

             $diff = abs(strtotime($returndate) - strtotime($datetoday));
             $years = floor($diff / (365*60*60*24));
             $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
             $returndaysleftchange = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

       ?>

           <tr>
             <td><?php echo $row->uid; ?></td>
             <td><?php echo $row->bcode; ?></td>
             <td><?php echo $row->borrowdate; ?></td>
             <td><?php echo $row->returndate; ?></td>
             <td><?php echo $row->borrowstatus; ?></td>
             <td><?php echo $row->reissueStatus; ?></td>
             <td><?php echo $returndaysleftchange." days left to return"; ?></td>
             <td><?php echo $row->reissuedate; ?></td>
             <td>
                 <a href="userReissuebook.php?reissue=1&bcode=<?php echo $row->bcode; ?>&uid=<?php echo $row->uid; ?>"><input type="Submit" name="reissue" value="REISSUE"></a>
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
