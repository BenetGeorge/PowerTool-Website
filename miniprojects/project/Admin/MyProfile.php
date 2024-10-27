<?php
session_start();
include("../assets/connection/connection.php");
$user = "SELECT * FROM tbl_adminreg WHERE id = '".$_SESSION['uid']."'";
$result=$con->query($user);
$data=$result->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="HomePage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <h3 align="center">MY PROFILE</h3>
  <div align="center">
  <table width="365" height="283" border="1">
    <tr>
    <td>Name</td>
      <td><?php echo $data['name'];?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $data['email'];?></td>
    </tr>
  </table>
</form>
</body>
</html>