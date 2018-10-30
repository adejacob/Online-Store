<div id="right">
	<h3>Add New Products From Here</h3>
		<form method="post" enctype="multipart/form-data">
			<table>
			<tr>
				<td>Enter Products Name :</td>
				<td><input type="text" name="pro_name" /></td>
			</tr>
			<tr>
				<td>Select Categories Name :</td>
				<td><select name="cat_name"><?php include("inc/functions.php"); echo viewall_cat(); ?></select></td>
			</tr>
			<tr>
				<td>Select Subcategories Name :</td>
				<td><select name="sub_cat_name"><?php echo viewall_Sub_cat(); ?></select></td>
			</tr>
			<tr>
				<td>Select Products Image 1 :</td>
				<td><input type="file" name="pro_img1" /> </td>
			</tr>
			<tr>
				<td>Select Products Image 2 :</td>
				<td><input type="file" name="pro_img2" /></td>
			</tr>
			<tr>
				<td>Select Products Image 3 :</td>
				<td><input type="file" name="pro_img3" /> </td>
			</tr>
			<tr>
				<td>Select Products Image 4 :</td>
				<td><input type="file" name="pro_img4" /></td>
			</tr>
			<tr>
				<td>Enter Feature1 :</td>
				<td><input type="text" name="pro_feature1" /></td>
			</tr>
			<tr>
				<td>Enter Feature2 :</td>
				<td><input type="text" name="pro_feature2" /></td>
			</tr>
			<tr>
				<td>Enter Feature3 :</td>
				<td><input type="text" name="pro_feature3" /></td>
			</tr>
			<tr>
				<td>Enter Feature4 :</td>
				<td><input type="text" name="pro_feature4" /></td>
			</tr>
			<tr>
				<td>Enter Feature5 :</td>
				<td><input type="text" name="pro_feature5" /></td>
			</tr>
			<tr>
				<td>Enter Price :</td>
				<td><input type="text" name="pro_price" /></td>
			</tr>
			<tr>
				<td>Enter Model No :</td>
				<td><input type="text" name="pro_model" /></td>
			</tr>
			<tr>
				<td>Enter Warranty :</td>
				<td><input type="text" name="pro_warranty" /></td>
			</tr>
			<tr>
			   <td>For Whome  :</td>
			   <td>
				<select name="for_whome">
					<option></option>
					<option value="men">Men</option>
					<option value="women">Women</option>
					<option value="kids">Kids</option>
				</select>
			   </td>
			   </tr>
			<tr>
				<td>Enter Keyword :</td>
				<td><input type="text" name="pro_keyword" /></td>
			</tr>
			
		</table>
		<center><button name="add_sub"> Add products  </button></center>
		</form>
	</div>

	<?php
	  
	  echo add_sub();
	  

	  ?>	