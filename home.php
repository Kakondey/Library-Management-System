

<html>
  <head>
    <title>Admin panel.php</title>
    <link rel="stylesheet" href="user/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css"/>
    <style media="screen">
    .btnadmin{
      background-color: white;
      border-radius: 5px;
      border-color: #317ee2;
      color: #317ee2;
      padding: 15px 32px;
      text-align: center;
      text-shadow: 3px;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
    .btnadmin:hover{
      background-color: #317ee2 ;
      border-color: white;
      color: white;
    }
    .btnuser{
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
    .btnuser:hover{
      background-color: #317ee2 ;
      border-color: white;
      color: white;
    }
    .letters{
      color: white;
    }
    </style>
  </head>
  <body background="assets/admin2.jpg">
      <div style="width:300px; margin:80px; ">
        <div>
          <center><h2 class="letters">WELCOME</h2></center>
          <center><h2 class="letters">to online library management system<h2></center>
          <center><h2 class="letters">Login as </h2></center>
          <center><h3><a href="Admin/SigninAdmin.php"><input type="submit" name="admin" value="ADMIN" class="btnadmin"></a> </h3></center>
          <center><h3><a href="user/signin-user.php"><input type="submit" name="user" value="USER" class="btnuser"></a></h3></center>
        </div>
      </div>
  </body>
</html>
