<option>--select--</option>
<?php 
include('../Connection/connection.php');
         $sequery="select*from tbl_subcat where cat_id='".$_GET['did']."'";
	   $res=$con->query($sequery); 
	   while($data=$res->fetch_assoc())
	   {
		   ?>
              <option value="<?php echo $data['subcat_id']?>"><?php echo $data['subcat_name']?></option>
              <?php
	}
	?>