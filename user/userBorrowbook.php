<?php
session_start();
if(!isset($_SESSION['uid']))
{
  header("signin-user.php");
}
else
{
  include_once('../dbconnect.php');


  $error = "0";
  $firstname = "0";
  $lastname = "0";
  $uid = "0";
  $booknm = "";
  $bauthor = "";
  $category = "";
  $bcode = "";
  $bprice = "";
  $bpublisher = "";
  $racknum = "";
  $borrower = "";
  $borrowdate = "";


  $query = "SELECT * FROM newuserdata WHERE uid ='".$_SESSION['uid']."'";
  $result = mysqli_query($conn, $query);

  function countnumberofenteries($conn)
  {
    $borrowname = $_POST['borrower'];
    $queryb1 = "SELECT COUNT(uid) FROM borrower WHERE firstname LIKE '%$borrowname%' OR lastname LIKE '%$borrowname%' OR uid LIKE '%$borrowname%' AND borrowstatus='pending'";
    $fetchb1 = mysqli_query($conn,$queryb1);
    $rowb1 = mysqli_fetch_row($fetchb1);
    return $rowb1[0];
  }

  if(isset($_POST['Borrow-btn']))
  {
    $borrowname = mysqli_real_escape_string($conn,$_POST['borrower']);

    $queryb = "SELECT firstname, lastname, uid FROM newuserdata WHERE firstname LIKE '%$borrowname%' OR lastname LIKE '%$borrowname%' OR uid LIKE '%$borrowname%'";
    $fetch = mysqli_query($conn, $queryb);
    $row = mysqli_fetch_array($fetch);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $uid = $row['uid'];



    $borrowstatus = "pending";
    $reissueStatus = "not reissued";
    $selectbook = $_POST['selectbook'];
    $returndate = date("Y-m-d", strtotime($_POST['returndate']));
    $borrowdate = date("Y-m-d");
    $reissuedate = date("0000-00-00");
    $fine = 0;

    $diff = abs(strtotime($returndate) - strtotime($borrowdate));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $returndaysleft = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));




    if($selectbook)
    {
      foreach ($selectbook as $value)
      {

            if($returndaysleft != 7 )
            {
              $error = true;
              echo "<script>
              alert('Book can be Borrowed for only 7 days. You marked $returndaysleft days.');
              window.location.href='userBorrowbook.php';
              </script>
              ";
            }


            if(countnumberofenteries($conn) >= 4)
            {
              $error = true;
              echo "<script>
              alert('You already borrowed 4 Book(s).');
              window.location.href='userBorrowbook.php';
              </script>
              ";
            }

          $querybk = "SELECT booknm, bauthor, category, bcode, bprice, bpublisher, racknum FROM newbook WHERE bcode LIKE '%$value%'";
          $fetchbk = mysqli_query($conn, $querybk);
          $row = mysqli_fetch_array($fetchbk);
          $booknm = $row['booknm'];
          $bauthor = $row['bauthor'];
          $category = $row['category'];
          $bcode = $row['bcode'];
          $bprice = $row['bprice'];
          $bpublisher = $row['bpublisher'];
          $racknum = $row['racknum'];



          //validate the data....
          if(empty($returndate))
          {
            $error = true;
            $errorreturndate = 'Please input the return date of book(s).';
          }
          if(empty($selectbook))
          {
            $error = true;
            $errorselectbook = 'Please select atleast one Book.';
          }

          if(!$error)
          {
            $queryinsert = "INSERT INTO borrower(uid, firstname, lastname, borrowdate, returndate, booknm, bauthor, category, bcode, bprice, bpublisher, racknum, borrowstatus)
                            VALUES('$uid','$firstname','$lastname','$borrowdate','$returndate','$booknm','$bauthor','$category','$bcode','$bprice','$bpublisher','$racknum','$borrowstatus')";

            mysqli_query($conn, $queryinsert);

            $queryreissue = "INSERT INTO reissue_finelist(uid, bcode, borrowdate, returndate, borrowstatus, reissueStatus, reissuedate, fine)
                             VAlUES('$uid','$bcode','$borrowdate','$returndate','$borrowstatus','$reissueStatus','$reissuedate','$fine')";

            mysqli_query($conn, $queryreissue);
          }
          else {
            echo "Error!!!".mysqli_error($conn);
          }


    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <title>Borrow Books</title>
        <link rel="stylesheet" href="../assets/style.css">
        <title>jQuery UI Datepicker - Default functionality</title>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <script type="text/javascript">
        function val()
        {
          var selectbook = document.getElementsByName('selectbook[]');
          var haschecked = false;
          for (var i = 0; i < selectbook.length; i++) {
            if(selectbook[i].checked)
            {
              haschecked = true;
              break;
            }
          }
          if(haschecked = false)
          {
            alert("Please select at least one Book!");
            return false;
          }
          return true;
        }
      </script>
      <style media="screen">
      .btnborrow{
        background-color: white;
        border-radius: 5px;
        border-color: #317ee2;
        color: #317ee2;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 3px;
        cursor: pointer;
      }
      .btnborrow:hover{
        background-color: #317ee2 ;
        border-color: white;
        color: white;
      }
        }
      </style>
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

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div>
        <p><h3>Name of Borrower:
          <br>
           <select name="borrower">
             <?php while($row = mysqli_fetch_array($result)):; ?>
             <option value="<?php echo $row['uid']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
           <?php endwhile; ?>
           </select>
           </h3>
        </p>
      </div>
      <div>
        <p>
          <h3>
            Date will return:
            <br>
            <input type="date" name="returndate">
          </h3>
        </p>
      </div>
      <div>
        <center>
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
            <th>Action</th>
          </tr>

          <?php

            $sql = "SELECT * FROM newbook";
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0)
            {
              $i = 1;
              while ($row = mysqli_fetch_object($query))
              {
                  $bcode = $row->bcode;
                  $totbooks = $row->totbooks;

                      $borrow_details = mysqli_query($conn,"SELECT * FROM borrower WHERE bcode = '$bcode' AND borrowstatus='pending'");
                      $row1 = mysqli_fetch_array($borrow_details);
                      $count = mysqli_num_rows($borrow_details);


                        $totalbooksleft = $totbooks - $count;

          ?>

              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->booknm; ?></td>
                <td><?php echo $row->bauthor; ?></td>
                <td><?php echo $row->category; ?></td>
                <td><?php echo $row->bcode; ?></td>
                <td><?php echo $row->bprice; ?></td>
                <td><?php echo $row->bpublisher; ?></td>
                <td>
                  <?php

                  if($totalbooksleft <= 3)
                  {
                    echo "<p style='color:red;'>stock low : $totalbooksleft</p>";
                  }
                  elseif ($totalbooksleft == 0)
                  {
                    echo "<p style='color:red;'>out of stock</p>";
                  }
                  else
                  {
                    echo $totalbooksleft;
                  }
                  ?></td>
                <td><?php echo $row->racknum; ?></td>
                <td>
                  <input type="checkbox" name="selectbook[]" multiple="multiple" value="<?php echo $row->bcode; ?>">


                </td>
              </tr>


          <?php
              }
            }

           ?>
        </table>
        <input type="submit" name="Borrow-btn" value="Borrow" class="btnborrow">
        </center>
      </div>

    </form>


  </body>
</html>
<?php } ?>
