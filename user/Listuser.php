<?php

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
          <a href="../book/BorrowOverdue.php">Reissue Books</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)" class="users-dropdown">USERS ▼</a>
        <div class="dropdown-content">
          <a href="../Admin/Adduser.php">Add Users</a>
          <a href="Listuser.php">List of Users</a>
          <a href="../book/BorrowOverdue.php">User Fine</a>
        </div>
      </li>
      <li><a href="../Admin/Adminsearchbook.php">Search(Books)</a></li>
      <li><a href="../Admin/AdminLogout.php">LOG OUT</a></li>
    </ul>

    <center>
    <table cellpadding="8" cellspacing="0" border="1" style="margin: 150px;">
      <tr>
        <th>No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User ID</th>
        <th>Roll No</th>
        <th>Age</th>
        <th>Class</th>
        <th>Section</th>
        <th>Actions</th>
      </tr>
      <?php

        $sql = "SELECT * FROM newuserdata";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {
          $i = 1;
          while ($row = mysqli_fetch_object($query))
          {
      ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row->firstname; ?></td>
            <td><?php echo $row->lastname; ?></td>
            <td><?php echo $row->uid; ?></td>
            <td><?php echo $row->rollno; ?></td>
            <td><?php echo $row->age; ?></td>
            <td><?php echo $row->class; ?></td>
            <td><?php echo $row->section; ?></td>
            <td>
                <a href="../Admin/AdminEdituser.php?edit=1&uid=<?php echo $row->uid; ?>"><input type="Submit" name="EDIT" value="EDIT"></a>
                <a href="../Admin/AdminEdituser.php?delete=1&uid=<?php echo $row->uid; ?>"><input type="Submit" name="DELETE" value="DELETE"></a>
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
