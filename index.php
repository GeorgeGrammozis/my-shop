<?php 
	require("config.php");
	require("php/functions.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	
	<meta name="keywords" content="<?php echo $meta_page_keywords["index-page"]; ?>">
	<meta name="description" content="<?php echo $meta_page_description["index-page"]; ?>">
	
	<meta name="language" content="el-gr" />
	<meta name="Robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	
	<!-- <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png"> -->
	<!-- <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon.ico"> -->
	<!-- <link rel="manifest" href="/site.webmanifest"> -->

	<!-- Structured data in json fornat -->
	<?php //include('html/structured-data-json.php'); ?>
	
	<!-- Google analytics script go uncomment when publishing !IMPORTANT-->
	<?php //include('html/google-analytics.php'); ?>

	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	<title><?php echo $brand_name; ?></title>
</head>
<body>
	<?php include 'includes/nav.php'; ?>
	<?php include 'includes/slides.php'; ?>


	


	

	<?php include 'includes/footer.php'; ?>
	<script src="js/functions.js"></script>
</body>
</html>