<div id="right">
	<h3>View All Categories</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
		<tr>
			<th>Sir No</th>
			<th>Category Name</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
			<?php include("inc/functions.php"); echo viewall_category(); ?> 
		</table>
	</form>
	<h3 id="add_cat" >Add New Categories From Here</h3>
		<form method="post">
			<table>
			<tr>
				<td>Enter Categories Name :</td>
				<td><input type="text" name="cat_name" /></td>
			</tr>
		</table>
		<center><button name="add_cat">Add Categories</button></center>
		</form>
	</div>

	<?php
	  
	  echo add_cat();

	  ?>	