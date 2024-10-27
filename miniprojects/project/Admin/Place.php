
 <?php
  include('../Assets/Connection/connection.php');
  include('Head.php');  if(isset($_POST['submit_btn']))
  {
	 $place=$_POST['txtplace'];
	 $district=$_POST['sel_district'];
	 $insquery="insert into tbl_place(place_name,district_id)  values('".$place."','".$district."')";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="place.php"
		</script>
        <?php
		 
		 
		 
	 }
	 //echo $place;
  }
  if(isset($_GET['did']))
  {
	  $val=$_GET['did'];
	  $delqry="delete from tbl_place where place_id=$val";
	  if($con->query($delqry))
	  {
  ?>
  <script>
  alert('Deleted')
  window.location="Place.php"
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
</head>

<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<!-- Form for Adding Place -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="Place.php" method="post">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            Add Place
          </div>
          <div class="card-body">
            <!-- District Dropdown -->
            <div class="form-group">
              <label for="sel_district">District</label>
              <select class="form-control" name="sel_district" id="sel_district" required>
                <option value="">...select...</option>
                <?php 
                  $sequery = "select * from tbl_district";
                  $res = $con->query($sequery);
                  while($data = $res->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                <?php } ?>
              </select>
            </div>

            <!-- Place Input -->
            <div class="form-group">
              <label for="txtplace">Place</label>
              <input type="text" class="form-control" name="txtplace" id="txtplace" placeholder="Enter place" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <input type="submit" name="submit_btn" id="submit_btn" class="btn btn-success" value="Submit">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Table for Displaying Places -->
  <br />
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">SL No</th>
            <th scope="col">District</th>
            <th scope="col">Place</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $i = 0;
          $selquery = "select * from tbl_place p inner join tbl_district d on p.district_id = d.district_id";
          $result = $con->query($selquery);
          while ($row = $result->fetch_assoc()) {
            $i++;
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['district_name']; ?></td>
            <td><?php echo $row['place_name']; ?></td>
            <td>
              <a href="Place.php?did=<?php echo $row['place_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
          </tr>
        <?php } ?>
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