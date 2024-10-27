<?php

include('../Assets/Connection/connection.php');
include('Head.php');

  if(isset($_GET['did']))
  {
	  $id=$_GET['did'];
	  $delqry="delete from tbl_user where user_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('deleted')
		  window.location="UserList.php"
		  </script>
          <?php
	  }
  }
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UserList</title>
</head>


<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<div class="container">
  <h3 class="text-center mt-4">User List</h3>
  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">SINo</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Contact</th>
        <th scope="col">Address</th>
        <th scope="col">Photo</th>
        <th scope="col">Place</th>
        <th scope="col">District</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "SELECT * FROM tbl_user s 
                   INNER JOIN tbl_place p ON s.place_id = p.place_id 
                   INNER JOIN tbl_district d ON d.district_id = p.district_id";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["user_email"]; ?></td>
        <td><?php echo $row["user_contact"]; ?></td>
        <td><?php echo $row["user_address"]; ?></td>
        <td>
          <img src="../Assets/Files/photo/<?php echo $row["user_photo"]; ?>" width="80" height="80" alt="User Photo">
        </td>
        <td><?php echo $row["place_name"]; ?></td>
        <td><?php echo $row["district_name"]; ?></td>
        <td>
          <a href="UserList.php?acid=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php include('Foot.php'); ?>