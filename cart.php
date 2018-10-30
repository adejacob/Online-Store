<!DOCTYPE html>
<html>
<head>
	<title>Online Store</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
</head>
<body>

<?php 
include("inc/function.php"); 
include("inc/header.php"); 
include("inc/navbar.php"); 

?>

<div class="cart">
	<form method="post" enctype="multipart/form-data">
		
			<?php echo cart_display(); ?>
		</table>
	</form>
</div>

<?php include("inc/footer.php"); ?>

	


</body>
</html>