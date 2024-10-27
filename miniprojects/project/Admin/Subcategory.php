
<?PHP
include ('../Assets/Connection/connection.php');
include('Head.php');
if(isset($_POST['btn_submit']))
{
$subcat=$_POST['SUBCATEGORY_ID'];
$insquery="insert into tbl_subcat(subcat_name,cat_id)values('".$subcat."','".$_POST['category_id']."')";
if($con->query($insquery));
{
?>
<script> alert("***data inserted***");
window.location="Subcategory.php"
</script>
<?php
}
}
if(isset($_GET['did']))
{
	$id=$_GET['did'];
	$delqery="delete from tbl_subcat where subcat_id='".$id."'";
	if($con->query($delqery));
	{
		?>
        <script> alert("***data deleted***");
window.location="Subcategory.php"
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

<div class="container">

  <!-- Form Section -->
  <form id="form1" name="form1" method="post" action="">
    <div class="card mt-4">
      <div class="card-header text-center">
        <h3>Add Subcategory</h3>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label for="category_id" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            <select name="category_id" id="category_id" class="form-control">
              <option>....SELECT....</option>
              <?php 
                $sequery = "select*from tbl_cat";
                $res = $con->query($sequery);
                while($row = $res->fetch_assoc()) {
              ?>
              <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
              <?php
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="SUBCATEGORY_ID" class="col-sm-2 col-form-label">Subcategory</label>
          <div class="col-sm-10">
            <input type="text" name="SUBCATEGORY_ID" id="SUBCATEGORY_ID" class="form-control" />
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>

  <!-- Table Section -->
  <h3 class="text-center mt-5">Subcategory List</h3>
  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">SL.NO</th>
        <th scope="col">Category</th>
        <th scope="col">Subcategory</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $selquery = "select * from tbl_subcat p inner join tbl_cat d on p.cat_id=d.cat_id";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['cat_name']; ?></td>
        <td><?php echo $row['subcat_name']; ?></td>
        <td>
          <a href="Subcategory.php?did=<?php echo $row['subcat_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getcat(did) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?did=" + did,
      success: function (result) {

        $("#subcat_id").html(result);
      }
    });
  }

</script>
<?php include('Foot.php'); ?>