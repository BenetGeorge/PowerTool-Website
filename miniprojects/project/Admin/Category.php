<?php

  include('../Assets/Connection/connection.php');
  include('Head.php');
  if(isset($_POST['btn_submit']))
  {
	 $cat=$_POST['txt_cat'];
	 $insquery="insert into tbl_cat(cat_name)values('".$cat."')";
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="category.php"
		</script>
        <?php
		 
		 
		 
	 }
	
  
  }
  if(isset($_GET['did']))
  {
	  $id=$_GET['did'];
	  $delqry="delete from tbl_cat where cat_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('deleted')
		  window.location="category.php"
		  </script>
          <?php
	  }
  }
  ?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<!-- Form for Adding Category -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="form1" name="form1" method="post" action="Category.php">
        <div class="card">
          <div class="card-header bg-primary text-white">
            Add Category
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="txt_cat">Category</label>
              <input type="text" class="form-control" name="txt_cat" id="txt_cat" placeholder="Enter Category" required>
            </div>
            <div class="text-center">
              <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-success" value="Submit">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Table for Displaying Categories -->
  <br />
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">SI NO</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $i = 0;
        $selquery = "select * from tbl_cat";
        $result = $con->query($selquery);
        while ($row = $result->fetch_assoc()) {
          $i++;
          ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row["cat_name"] ?></td>
            <td>
              <a href="Category.php?did=<?php echo $row['cat_id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
            </td>
          </tr>
          <?php
        }
        ?>
        </tbody>
</html>
<?php include('Foot.php'); ?>