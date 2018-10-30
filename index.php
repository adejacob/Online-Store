<!DOCTYPE html>
<html>
<head>
	<title>Online Store</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/cycle.js"></script>
	<script>
		$('#slider1').cycle('all');
	</script>
</head>
<body>

<?php 
include("inc/function.php"); 
include("inc/header.php"); 
include("inc/navbar.php"); 
include("inc/left.php"); 
include("inc/other-post.php"); 
include("inc/footer.php"); 
echo add_cart();
echo u_signup();
?>


	


</body>
</html>