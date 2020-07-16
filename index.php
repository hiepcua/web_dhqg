<?php
ob_start();
session_start();
ini_set('display_errors',1);
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path."FlashMessages.php");   // Flash message

header('Content-type: text/html; charset=utf-8');
header('Pragma: no-cache');//header('Pragma: public');
header('Expires: '.gmdate('D, d M Y H:i:s',time()+600).' GMT');
header('Cache-Control: max-age=600');
header('User-Cache-Control: max-age=600');
//------------------set cookie for member giới thiệu--------------------------
$req=isset($_GET['req'])?antiData($_GET['req']):'';
if($req!='') setcookie('RES_USER',$req,time() + (86400 * 30), "/");
define('ISHOME',true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">		
	<title>Đại Học Quốc Gia</title>
	
	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="images/fav.png">
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
	<link href="css/vertical-responsive-menu.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	
	<!-- Vendor Stylesheets -->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="page" class="page">
		<!-- Header Start -->
		<?php include 'modules/header.php';?>
		<!-- Header End -->
		<!-- Main Content Area Start -->
		<div id="mainArea" class="main-base">
			<?php 
			$com=isset($_GET['com'])?$_GET['com']:'frontpage';
			include_once('components/com_'.$com.'/layout.php');
			?>
		</div>
		<!-- Main Content Area End -->
		<!-- Footer Start -->
		<?php include 'modules/footer.php';?>
		<!-- Footer End -->
	</div>
	<script src="js/vertical-responsive-menu.min.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>