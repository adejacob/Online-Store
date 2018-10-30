<div id="left">
   <h3>Content Management</h3>
   <ul>
   	<li><a href="index.php">Home</li></a>
   	<li><a href="index.php?viewall_cat">View Categories</li></a>
   	<li><a href="index.php?viewall_sub_cat">View  Sub Categories</li></a>
   	<li><a href="index.php?add_product">Add New Products</li></a>
   	<li><a href="index.php?viewall_product">View All Products</li></a>

   </ul>
	</div>
<?php 
 if(isset($_GET['viewall_cat'])){
 	include("cat.php");
 }

 if(isset($_GET['viewall_sub_cat'])){

 	include("sub_cat.php");
 }

if(isset($_GET['viewall_product'])){

 	include("viewall_product.php");
 }

 if(isset($_GET['add_product'])){

 	include("add_product.php");
 }

?>