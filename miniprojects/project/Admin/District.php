
   
  <?php
  include('../Assets/Connection/connection.php');
  include('Head.php');
  if(isset($_POST['txt_submit']))
  {
	 $district=$_POST['txt_district'];
	 $insquery="insert into tbl_district(district_name) values('".$district."')";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="District.php"
		</script>
        <?php
		 
		 
		 
	 }
	 //echo $district;
  }
  
  
    if(isset($_GET['did']))
  {
	  $id=$_GET['did'];
	  $delqry="delete from tbl_district where district_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('deleted')
		  window.location="District.php"
		  </script>
          <?php
	  }
  }
  
  
  ?>
   
   
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
</head>

<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<!-- Form for Adding District -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="form1" name="form1" method="post" action="">
        <div class="card">
          <div class="card-header bg-primary text-white">
            Add District
          </div>
          <div class="card-body">
            <!-- District Input -->
            <div class="form-group">
              <label for="txt_district">District</label>
              <input type="text" class="form-control" name="txt_district" id="txt_district" placeholder="Enter district" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <input type="submit" name="txt_submit" id="txt_submit" class="btn btn-success" value="Submit">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Table for Displaying Districts -->
  <br>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">S1.NO</th>
            <th scope="col">District</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i = 0;
          $selqry = "select * from tbl_district";
          $result = $con->query($selqry);
          while ($row = $result->fetch_assoc()) {
            $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["district_name"]; ?></td>
            <td>
              <a href="District.php?did=<?php echo $row['district_id']; ?>" class="btn btn-danger btn-sm">DELETE</a>
            </td>
          </tr>
          <?php 
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php include('Foot.php'); ?>