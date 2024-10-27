<?php	
include('../Assets/Connection/Connection.php');
include('Head.php');

// Get the rent_id from the URL
if (isset($_GET['rid'])) {
    $rent_id = $_GET['rid'];

    // Fetch product details using the rent_id
    $sel = "SELECT * FROM tbl_rentitem r 
            INNER JOIN tbl_shop s ON r.shop_id = s.shop_id 
            INNER JOIN tbl_subcat t ON r.subcat_id = t.subcat_id 
            INNER JOIN tbl_cat c ON t.cat_id = c.cat_id 
            WHERE r.rent_id = $rent_id";
            
    $res = $con->query($sel);
    $data = $res->fetch_assoc();
} else {
    // Redirect to home if no rent_id is found
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-image {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="../Assets/Files/RentItem/<?php echo $data['rent_image']; ?>" alt="Product Image" class="product-image img-fluid">
        </div>
        <div class="col-md-6">
            <h3><?php echo $data['rent_name']; ?></h3>
            <p><strong>Price:</strong> <?php echo $data['rent_price']; ?></p>
            <p><strong>Category:</strong> <?php echo $data['cat_name']; ?></p>
            <p><strong>Subcategory:</strong> <?php echo $data['subcat_name']; ?></p>
            <p><strong>Details:</strong> <?php echo $data['rent_details']; ?></p>
            <p><strong>Shop:</strong> <?php echo $data['shop_name']; ?></p>

            <div class="mt-4 d-flex">
                <a href="Request.php?rid=<?php echo $data['rent_id']; ?>" class="btn btn-primary mr-2">
                    <i class="fas fa-shopping-cart"></i> Request
                </a>
                <a href="ViewRentItem.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FontAwesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybI4Pvp23M1CQP6Ap7ot72mxPWvT8lRGVpanhLJbmQxMqsmA6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93LbAbzG9K11AqIpSejmDHDK9a/f0lM5JdTE8sTnUKj83GGeZfSKv2gRl5Pvo0" crossorigin="anonymous"></script>

</body>
</html>

<?php include('Foot.php'); ?>
