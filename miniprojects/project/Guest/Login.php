<?php
session_start();
include('../Assets/Connection/connection.php');

if (isset($_POST['submitbtn'])) {
	$email = $_POST['emailtxt'];
	$password = $_POST['passwordtxt'];

	$user = "select * from tbl_user where user_email='" . $email . "' AND user_password='" . $password . "'";
	$resuser = $con->query($user);

	$admin = "select * from tbl_adminreg where email='" . $email . "' AND password='" . $password . "'";
	$resadmin = $con->query($admin);

	$shop = "select * from tbl_shop where shop_email='" . $email . "' AND shop_password='" . $password . "' and shop_status='1'";
	$resshop = $con->query($shop);

	if ($datauser = $resuser->fetch_assoc()) {
		$_SESSION['uid'] = $datauser['user_id'];
		$_SESSION['uname'] = $datauser['user_name'];
		header('location:../User/HomePage.php');
	} else if ($dataadmin = $resadmin->fetch_assoc()) {
		$_SESSION['aid'] = $dataadmin['admin_id'];
		$_SESSION['uname'] = $dataadmin['admin_name'];
		header('location:../admin/HomePage.php');
	} else if ($datashop = $resshop->fetch_assoc()) {
		$_SESSION['sid'] = $datashop['shop_id'];
		$_SESSION['uname'] = $datashop['shop_name'];
		header('location:../Shop/HomePage.php');
	} else {
?>
		<script>
			alert('Invalid Data')
		</script>
<?php
	}
}
?>
<!-- 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
</head>

<body>
	<form id="form1" name="form1" method="post" action="">
		<table width="200" border="1" align="center">
			<tr>
				<td>Email</td>
				<td><label for="emailtxt"></label>
					<input type="email" name="emailtxt" id="emailtxt" />
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td><label for="passwordtxt"></label>
					<input type="password" name="passwordtxt" id="passwordtxt" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submitbtn" id="submitbtn" value="LOGIN" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><a href="NewShop.php">NewShop</a>/<a href="NewUser.php">NewUser</a></td>
			</tr>
		</table>
	</form>
</body>

</html> -->




<html lang="en">

<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style>
		body,
		html {
			height: 100%;
			background: #1c1e21;
			overflow-x: hidden;
			font-family: 'Dosis', sans-serif;
		}

		btn {
			border-radius: 0
		}

		.btn:focus,
		.btn:active,
		.btn.active,
		.btn:active:focus {
			outline: 0;
			border-radius: 0
		}



		.btn-larger {
			padding: 15px 40px !important;
			border: 2px solid #F7CA18 !important;
			;
			border-radius: 0px !important;
			;
			text-transform: uppercase;
			font-family: 'Dosis', sans-serif;
			font-size: 18px;
			font-weight: 300;
			color: #F7CA18;
			background-color: transparent;
			-webkit-transition: all .6s;
			-moz-transition: all .6s;
			transition: all .6s;


		}

		.btn-larger:hover,
		.btn-larger:focus,
		.btn-larger:active,
		.btn-larger.active,
		.open .dropdown-toggle.btn-larger {
			border-color: #F7CA18;
			color: #fff;
			background-color: #F7CA18;
			border-radius: 0
		}

		.btn-larger:active,
		.btn-larger.active,
		.open .dropdown-toggle.btn-larger {
			background-image: none;
		}

		.btn-larger.disabled,
		.btn-larger[disabled],
		fieldset[disabled] .btn-larger,
		.btn-larger.disabled:hover,
		.btn-larger[disabled]:hover,
		fieldset[disabled] .btn-larger:hover,
		.btn-larger.disabled:focus,
		.btn-larger[disabled]:focus,
		fieldset[disabled] .btn-larger:focus,
		.btn-larger.disabled:active,
		.btn-larger[disabled]:active,
		fieldset[disabled] .btn-larger:active,
		.btn-larger.disabled.active,
		.btn-larger[disabled].active,
		fieldset[disabled] .btn-larger.active {
			border-color: #AEA8D3;
			background-color: #AEA8D3;
		}

		.btn-larger .badge {
			color: #AEA8D3;
			background-color: #fff;
		}

		div#form {
			color: #fff;
			background-attachment: scroll;
			background-image:url(../Assets/Templates/Main/images/slider-main/Background2.webp);
			background-position: center center;
			background-repeat: none;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
			min-height: 100%;

		}

		#userform p {
			font-size: 14px;
			margin-bottom: 5px;
		}

		#userform ul {
			list-style-type: none;
			padding: 0;
			margin-bottom: 0px;
		}

		#userform {
			background: rgba(0, 0, 0, 0.8);
			margin: 20px 0 20px 0
		}

		@media (min-width: 768px) {
			#userform {
				background: rgba(0, 0, 0, 0.8);
				margin: 50px 0 20px 0
			}
		}

		#userform .nav-tabs.nav-justified>li>a {
			text-transform: uppercase;
			font-size: 20px;
			color: #F7CA18;
			background-color: rgba(90, 90, 90, 0.5);
		}

		#userform .nav-tabs.nav-justified>.active>a,
		#userform .nav-tabs.nav-justified>.active>a:hover,
		#userform .nav-tabs.nav-justified>.active>a:focus {
			border: 0;
			background: #F7CA18;
			color: white;
			border-radius: 0;
		}

		#userform .nav-justified>li>a {
			margin-bottom: 0;
			-webkit-transition: all .6s;
			-moz-transition: all .6s;
			transition: all .6s;
		}

		#userform .nav-justified>li>a:hover {
			background: #AEA8D3;
			color: #FFF;
		}

		#userform .nav-tabs>li>a {
			border: 0px solid transparent;
			border-radius: 0
		}

		#userform .nav-tabs.nav-justified>li>a:hover {
			background: #F7CA18;
			color: #FFF;
			border-radius: 0;
			border: 0;
			-webkit-transition: all .6s;
			-moz-transition: all .6s;
			transition: all .6s;
		}

		#userform .nav-tabs>li.active>a,
		#userform .nav-tabs>li.active>a:hover,
		#userform .nav-tabs>li.active>a:focus {
			color: #F7CA18;
			cursor: default;
			background-color: transparent;
			border: 0;
			-webkit-transition: all .6s;
			-moz-transition: all .6s;
			transition: all .6s;
		}

		@media (min-width: 768px) {
			#userform .nav-tabs.nav-justified>li>a {
				border: 0;
				-webkit-transition: all .6s;
				-moz-transition: all .6s;
				transition: all .6s;
			}

			#userform .nav-tabs.nav-justified>li>a:hover {
				background-color: #F7CA18;
				border-color: transparent;
				border: 0;
				-webkit-transition: all .6s;
				-moz-transition: all .6s;
				transition: all .6s;
			}
		}

		@media (max-width: 768px) {
			.nav-justified>li {
				display: table-cell !important;
				width: 1% !important;
			}
		}

		#userform .nav-tabs {
			border-bottom: 0px solid #ddd;
		}

		#userform .tab-pane h2 {
			margin: 10px 0;
			color: #FFF;
		}

		#userform .tab-pane p.lead {
			margin-top: 20px;
		}

		#userform .tab-content {
			padding: 20px
		}

		#userform .form-group {
			margin-bottom: 0px;
			color: #FFF;
		}

		#userform .form-group input,
		#userform .form-group textarea {
			padding: 10px;
		}

		#userform .form-group input.form-control {
			height: auto;
			background-color: rgba(237, 235, 250, 0.1);
			color: #FFF;
		}

		#userform .form-control {
			border-radius: 0;
			border: 1px solid #fff;
		}

		#userform .form-control:focus {
			border-color: #F7CA18;
			box-shadow: none;
		}

		#userform::-webkit-input-placeholder {
			text-transform: uppercase;
			font-family: 'Dosis', sans-serif;
			font-weight: 700;
			color: #bbb;
		}

		#userform #signup .form-group label {
			position: relative;
			-webkit-transform: translateY(35px);
			-ms-transform: translateY(35px);
			transform: translateY(35px);
			left: 10px;
			top: 0px;
			color: rgba(255, 255, 255, 0.5);
			-webkit-transition: all 0.25s ease;
			transition: all 0.25s ease;
			-webkit-backface-visibility: hidden;
			pointer-events: none;
			font-size: 12px;
			font-weight: 300
		}

		#userform #signup .form-group label .req {
			margin: 2px;
			color: #F7CA18;
		}

		#userform #signup .form-group label.active {
			-webkit-transform: translateY(0px);
			-ms-transform: translateY(0px);
			transform: translateY(0px);
			left: 2px;
			font-size: 12px;
		}

		#userform #signup .form-group label.active .req {
			opacity: 0;
		}

		#userform label.highlight {
			color: #ffffff;
		}

		#userform #login .form-group label {
			position: relative;
			-webkit-transform: translateY(35px);
			-ms-transform: translateY(35px);
			transform: translateY(35px);
			left: 10px;
			top: 0px;
			color: rgba(255, 255, 255, 0.5);
			-webkit-transition: all 0.25s ease;
			transition: all 0.25s ease;
			-webkit-backface-visibility: hidden;
			pointer-events: none;
			font-size: 12px;
			font-weight: 300
		}

		#userform #login .form-group label .req {
			margin: 2px;
			color: #F7CA18;
		}

		#userform #login .form-group label.active {
			-webkit-transform: translateY(0px);
			-ms-transform: translateY(0px);
			transform: translateY(0px);
			left: 2px;
			font-size: 12px;
		}

		#userform #login .form-group label.active .req {
			opacity: 0;
		}

		.mrgn-30-top {
			margin-top: 30px
		}
	</style>
</head>

<body>
	<div id="form">
		<div class="container">
			<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
				<div id="userform">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li class="active"><a href="#signup" role="tab" data-toggle="tab">Log in</a></li>
					</ul>
					<div class="tab-content">
						
							
						<div class="tab-pane fade active in" id="signup">
							<h2 class="text-uppercase text-center"> Log in</h2>
							<form id="signup" method="post">
								<div class="form-group">
									<label> Your Email<span class="req">*</span> </label>
									<input type="email" name="emailtxt"  class="form-control" id="email" required data-validation-required-message="Please enter your email address." autocomplete="off">
									<p class="help-block text-danger"></p>
								</div>
								<div class="form-group">
									<label> Password<span class="req">*</span> </label>
									<input type="password" name="passwordtxt" class="form-control" id="password" required data-validation-required-message="Please enter your password" autocomplete="off">
									<p class="help-block text-danger"></p>
								</div>
								<div class="mrgn-30-top">
									<button type="submit" name="submitbtn" class="btn btn-larger btn-block" />
									Log in
									</button>
									
    


									<div style="text-align:center;">
									<a href="../Guest/NewUser.php">NEW USER</a>/
									<a href="../Guest/NewShop.php">NEW SHOP</a>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container -->
	</div>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script>
		$('#form').find('input, textarea').on('keyup blur focus', function(e) {

			var $this = $(this),
				label = $this.prev('label');

			if (e.type === 'keyup') {
				if ($this.val() === '') {
					label.removeClass('active highlight');
				} else {
					label.addClass('active highlight');
				}
			} else if (e.type === 'blur') {
				if ($this.val() === '') {
					label.removeClass('active highlight');
				} else {
					label.removeClass('highlight');
				}
			} else if (e.type === 'focus') {

				if ($this.val() === '') {
					label.removeClass('highlight');
				} else if ($this.val() !== '') {
					label.addClass('highlight');
				}
			}

		});

		$('.tab a').on('click', function(e) {

			e.preventDefault();

			$(this).parent().addClass('active');
			$(this).parent().siblings().removeClass('active');

			target = $(this).attr('href');

			$('.tab-content > div').not(target).hide();

			$(target).fadeIn(800);

		});
	</script>
</body>