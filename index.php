<?php 
	require("config.php");
	require("php/functions.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="Robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<?php include("includes/head.php"); ?>

	<!-- Structured data in json fornat -->
	<?php //include('html/structured-data-json.php'); ?>
	
	<!-- Google analytics script go uncomment when publishing !IMPORTANT-->
	<?php //include('html/google-analytics.php'); ?>

	<title><?php echo BRAND_NAME; ?></title>
</head>
<body>
	<?php include 'includes/nav.php'; ?>
	<?php include 'includes/slides.php'; ?>


	


	

	<?php include 'includes/footer.php'; ?>
	<script src="js/functions.js"></script>
</body>
</html>