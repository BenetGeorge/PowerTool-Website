
<?php
  include('../Assets/Connection/connection.php');
  session_start();
  include('Head.php');
  if(isset($_POST['btn_submit']))
  {
	 $name=$_POST['txt_name'];
	 $details=$_POST['txt_details'];
	 $price=$_POST['txt_price'];
	 $subcategory=$_POST['txt_subcat'];
	 
	 $photo=$_FILES['photo_id']['name'];
	 $temp=$_FILES['photo_id']['tmp_name'];
	 move_uploaded_file($temp,'../Assets/Files/RentItem/'.$photo);
	 
	 
	 $insquery="insert into tbl_rentitem(rent_name,rent_details,rent_price,subcat_id,shop_id,rent_image) values('".$name."','".$details."','".$price."','".$subcategory."','".$_SESSION['sid']."','".$photo."')";
	 if ($con->query($insquery))
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="RentItem.php"
		</script>
        <?php
		 
  
	 }
  }
  
  
  
    if(isset($_GET['did']))
  {
	  $id=$_GET['did'];
	  $delqry="delete from tbl_rentitem where rent_id ='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('deleted')
		  window.location="RentItem.php"
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
    <div class="container mt-5">
        <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
            <h3 class="text-center">Add Rent Item</h3>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Category</strong></td>
                    <td>
                        <select name="txt_cat" id="txt_cat" class="form-control" onChange="getsubcat(this.value)">
                            <option>....select</option>
                            <?php 
                            $sequery = "SELECT * FROM tbl_cat";
                            $res = $con->query($sequery);
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Subcategory</strong></td>
                    <td>
                        <select name="txt_subcat" id="txt_subcat" class="form-control">
                            <option>....select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>
                        <input type="text" name="txt_name" id="txt_name" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Details</strong></td>
                    <td>
                        <textarea name="txt_details" id="txt_details" class="form-control" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td><strong>Price</strong></td>
                    <td>
                        <input type="text" name="txt_price" id="txt_price" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Photo</strong></td>
                    <td>
                        <input type="file" name="photo_id" id="photo_id" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
                    </td>
                </tr>
            </table>
        </form>
        <br />
        <h3 class="text-center">Rent Items List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SINo</th>
                    <th>Item Name</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selquery = "SELECT * FROM tbl_rentitem p INNER JOIN tbl_subcat d ON p.subcat_id = d.subcat_id INNER JOIN tbl_cat c ON c.cat_id = d.cat_id";
                $result = $con->query($selquery);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['rent_name']; ?></td>
                        <td><?php echo $row['rent_details']; ?></td>
                        <td><?php echo $row['rent_price']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['subcat_name']; ?></td>
                        <td><img src="../Assets/Files/RentItem/<?php echo $row['rent_image']; ?>" width="80" height="80" /></td>
                        <td><a href="Rentitem.php?did=<?php echo $row['rent_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getsubcat(did) {
    $.ajax({
      url: "../Assets/AjaxPages/Ajaxsubcat.php?did=" + did,
      success: function (result) {

        $("#txt_subcat").html(result);
      }
    });
  }

</script>
<?php include('Foot.php');?>
 