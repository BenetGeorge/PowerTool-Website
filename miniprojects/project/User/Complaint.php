<?php
  include('../Assets/Connection/connection.php');
 
  session_start();
  include('Head.php');
  if(isset($_POST['btn_submit']))
  {
	 $title=$_POST['txt_title'];
	 $content=$_POST['txt_content'];
	 $insquery="insert into tbl_complaint(complaint_title,complaint_content,user_id)values('".$title."','".$content."','".$_SESSION['uid']."')";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("Data Inserted")
		window.location="Complaint.php"
		</script>
        <?php
		 
		 
		 
	 }
	 //echo $place;
  }
  if(isset($_GET['did']))
  {
	  $val=$_GET['did'];
	  $delqry="delete from tbl_complaint where complaint_id= $val";
	  if($con->query($delqry))
	  {
  ?>
  <script>
  alert('Data Deleted')
  window.location="Complaint.php"
  </script>
  <?php
  }
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">

#form1 table tr td {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
</head>

<body>
    <div class="container mt-4">
        <form id="form1" name="form1" method="post" action="">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Complaint Form</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="txt_title">Title</label>
                        <input type="text" class="form-control" name="txt_title" id="txt_title" />
                    </div>
                    <div class="form-group">
                        <label for="txt_content">Content</label>
                        <textarea class="form-control" name="txt_content" id="txt_content" cols="45" rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th scope="col" class="text-center">SINo</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">Complaint</th>
                        <th scope="col" class="text-center">Reply</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selquery = "SELECT * FROM tbl_complaint WHERE user_id='" . $_SESSION['uid'] . "'";
                    $result = $con->query($selquery);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td class="text-center"><?php echo $row['complaint_title'] ?></td>
                            <td class="text-center"><?php echo $row['complaint_content'] ?></td>
                            <td class="text-center"><?php echo $row['complaint_reply'] ?></td>
                            <td class="text-center">
                                <a href="Complaint.php?did=<?php echo $row['complaint_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('Foot.php');?>
