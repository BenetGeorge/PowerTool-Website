<?php 
include('../Connection/connection.php');
         $sequery="select*from tbl_place where district_id='".$_GET['did']."'";
	   $res=$con->query($sequery); 
	   while($data=$res->fetch_assoc())
	   {
		   ?>
              <option value="<?php echo $data['place_id']?>"><?php echo $data['place_name']?></option>
              <?php
	}
	?>