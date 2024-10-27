<?php

include('../Assets/Connection/connection.php');

 if(isset($_POST['btn_submit']))
  {
	 $name=$_POST['txt_name'];
	 $email=$_POST['txt_email'];
	 $password=$_POST['txt_pass'];
	 $insquery="insert into tbl_adminreg(name,email,password)values('".$name."','".$email."','".$password."')";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="AdminRegistration.php"
		</script>
        <?php
		 
		 
		 
	 }
	
  
  }
  if(isset($_GET['did']))
  {
	  $id=$_GET['did'];
	  $delqry="delete from tbl_adminreg where id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('deleted')
		  window.location="AdminRegistration.php"
		  </script>
          <?php
	  }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdminRegistration</title>
</head>


<body>
<a href="HomePage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pass"></label>
      <input type="text" name="txt_pass" id="txt_pass" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <br />
  <table width="330" height="114" border="1" align="center">
    <tr>
      <td width="33">SINo</td>
      <td width="33">Name</td>
      <td width="33">Email</td>
      <td width="33">Password</td>
      <td width="53">Action</td>
    </tr>
<?php 
	$i=0;
	$selquery="select*from tbl_adminreg";
	$result=$con->query($selquery);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
 
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row["name"]?></td>
      <td><?php echo $row["email"]?></td>
      <td><?php echo $row["password"]?></td>
      <td><a href="AdminRegistration.php?did=<?php echo $row['id']?>">DELETE</a></td>
    </tr>
    <?php
	}
	?>
  
  </table>
</form>


</body>
</html>