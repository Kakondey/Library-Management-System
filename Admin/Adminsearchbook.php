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
    <title>search a book</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
      input[type=search]{
        width: 130px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 7px;
        font-size: 20px;
        background-color: white;
        margin: 0px 0px;
        background-position: 0px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;

      }

      input[type=search]:focus{
        width: 100%;
      }
    </style>

  </head>
  <body background = "../assets/bluebackground.jpg">
    <ul>
      <li><a href="../Admin/Admindashboard.php" style="hover background-color: #317ee2;;background-color: #0a3e91; text-decoration: none;">HOME</a></li>
      <li><a href="AdminLogout.php">LOG OUT</a></li>

    </ul>
    <div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      <div>

          <input type="search" name="keywords" placeholder="Search..." class="form-control" autocomplete="off">


      </div>

    </form>
    <hr>
        <?php
        if(isset($_POST['keywords']))
        {

              $keywords = $conn->escape_string($_POST['keywords']);

              $query = mysqli_query($conn,"SELECT * FROM newbook WHERE booknm LIKE '%$keywords%' OR bauthor LIKE '%$keywords%' OR category LIKE '%$keywords%' OR bcode LIKE '%$keywords%' OR bprice LIKE '%$keywords%' OR bpublisher LIKE '%$keywords%' OR racknum LIKE '%$keywords%'");
              $num_rows = mysqli_num_rows($query);

              while ($row = mysqli_fetch_array($query))
              {
                $booknm = $row['booknm'];
                $bauthor = $row['bauthor'];
                $bcategory = $row['category'];
                $bcode = $row['bcode'];
                $bprice = $row['bprice'];
                $bpublisher = $row['bpublisher'];
                $racknum = $row['racknum'];

             echo "<div class='container'>";
             echo "<div style='width:300px; margin:10px auto;'>";
             echo "<h3>";
             echo "<p><b>Name of Book: </b> ".$booknm."</p>";
             echo "<p><b>Author of the Book: </b> "  .$bauthor. "</p>";
             echo "<p><b>Category of the Book: </b> " .$bcategory. "</p>";
             echo "<p><b>Code of the Book:  </b>" .$bcode."</p>";
             echo "<p><b>Price of the Book: </b> ".$bprice. "</p>";
             echo "<p><b>Publisher of the Book: </b>".$bpublisher. "</p>";
             echo "<p><b>Rack number for the Book: </b> ".$racknum."</p>";
             echo "</h3>";
             echo "<br>";
             echo "<div class='form--group'>";
             echo "<a href='AdminEditbookdetails.php?edit=1&bcode=$row[bcode] '><input type='Submit' value='Edit Details' name='bdetailsedit-btn' class='btn btn-primary'></a>";
             echo "</br>";
             echo "  <a href='AdminEditbookdetails.php?delete=1&bcode=$row[bcode] '><input type='Submit' value='Delete Details' name='bdetailsdelete-btn' class='btn btn-primary'></a>";
             echo "</div>";
             echo "</div>";
             echo "</div>";
             echo "<hr>";
              }
            }

         ?>
    </div>
  </body>
</html>
<?php } ?>
