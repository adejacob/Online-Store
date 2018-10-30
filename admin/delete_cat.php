
<?php
  include("inc/functions.php");
   if(isset($_GET['delete_cat'])){
   	   echo delete_cat();
   	}
   	if(isset($_GET['delete_sub_cat'])){
      	echo delete_sub_cat();
   }
   	if(isset($_GET['delete_pro'])){
      	echo delete_product();
   }
?>