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
echo "<div id='left'>  <ul> ";cat_detail(); sub_cat_detail(); bd_kids(); bd_men(); bd_women(); all_about_men(); all_about_women(); all_about_kids(); echo" </ul></div>";
     if(isset($_GET['cat_id']) or isset($_GET['sub_cat_id'])) {	
echo "<div class='other-post' id='other-post'>";
  echo"<ul> ";viewall_sub_cat(); viewall_cat(); echo" </ul>";
   echo"</div><br clear='all' />";
       }
       else{
       	include("inc/other-post.php");
       }
include("inc/footer.php"); 
?>


	


</body>
</html>