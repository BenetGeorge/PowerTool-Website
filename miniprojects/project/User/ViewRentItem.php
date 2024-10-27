<?php	
include('../Assets/Connection/Connection.php');
include('Head.php');
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
<div class="container mt-5">
    <div class="row">
        <?php 
        $sel = "SELECT * FROM tbl_rentitem r 
                INNER JOIN tbl_shop s ON r.shop_id = s.shop_id 
                INNER JOIN tbl_subcat t ON r.subcat_id = t.subcat_id 
                INNER JOIN tbl_cat c ON t.cat_id = c.cat_id";

        $i = 0;
        $res = $con->query($sel);
        while ($data = $res->fetch_assoc()) {
            $i++;
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../Assets/Files/RentItem/<?php echo $data['rent_image']; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['rent_name']; ?></h5>
                    <p class="card-text">
                        <strong>Price:</strong> <?php echo $data['rent_price']; ?><br>
                        <strong>Category:</strong> <?php echo $data['cat_name']; ?><br>
                        <strong>Subcategory:</strong> <?php echo $data['subcat_name']; ?>
                    </p>
                    <div class="d-flex justify-content-between">
                        <a href="Request.php?rid=<?php echo $data['rent_id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-shopping-cart"></i> Request
                        </a>
                        <a href="ViewMore.php?rid=<?php echo $data['rent_id']; ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-info-circle"></i> View More
                        </a>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small>Shop: <?php echo $data['shop_name']; ?></small>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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