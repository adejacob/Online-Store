<div id="right">
	<h3>View All Sub Categories</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
		<tr>
			<th>Sir No</th>
			<th>Sub Category Name</th>
			<th>Edit</th>
			<th>Delect</th>
		</tr>
			<?php include("inc/functions.php"); echo viewall_sub_category(); ?> 
		</table>
	</form>
	<h3 id="add_cat" >Add New Sub Categories From Here</h3>
		<form method="post">
			<table> 
			<tr>
				<td>Select Categories Name :</td>
				<td><select name="main_cat">
					<?php 

	                echo viewall_cat();

					?></select></td>
			</tr>
			<tr>
				<td>Enter Sub Categories Name :</td>
				<td><input type="text" name="sub_cat_name" /></td>
			</tr>
		</table>
		<center><button name="add_sub_cat">Add Sub Categories</button></center>
		</form>
	</div>

	<?php
	  
	  echo add_sub_cat();
	  

	  ?>	