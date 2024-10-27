<?php

session_start();
include('../Assets/Connection/connection.php');
include('Head.php');


  if(isset($_POST['btn_submit']))
  {
	 $reply=$_POST['txtreply'];
	 $insquery="update tbl_complaint set complaint_reply='$reply',complaint_status='1' where complaint_id='".$_SESSION["cid"]."'";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("Replied..")
		window.location="ViewComplaint.php"
		</script>
        <?php
		 
		 
		 
	 }
	
  }
  
  	$selquery="select * from tbl_complaint c inner join tbl_user u on  c.user_id=u.user_id where complaint_id='".$_SESSION["cid"]."'";
	$result=$con->query($selquery);
	$row=$result->fetch_assoc();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewComplaint</title>
</head>


<body>
<a href="HomePage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td>Title</td>
      <td>
      <?php echo $row ['complaint_title']?></td>
    </tr>
    <tr>
      <td>Complaint</td>
      <td>
      <?php echo $row['complaint_content']?></td>
    </tr>
    <tr>
      <td>Reply</td>
      <td><label for="txtreply"></label>
      <textarea name="txtreply" id="txtreply"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>

 
</form>


</body>
</html>
<?php include('Foot.php'); ?>