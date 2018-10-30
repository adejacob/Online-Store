
	<div id="header">
		<div id="logo">
			<a href="index.php"><img src="imgs/capri.jpg"></a>
		</div>
		<div id="link">
			<ul>
				<li><a href="#"><i class="fa fa-download"></i> Download App</li></a>
					<li><a href="#"><i class="fa fa-user-plus"></i> Sign up</a>
						<form method="post" enctype="multipart/form-data">
					   	<table>
					   		<tr>
					   			<td><i class="fa fa-user"></i> Enter Your Name</td>
					   			<td><input type="text" name="u_name" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-envelope-square"></i>  Enter Your Email</td>
					   			<td><input type="email" name="u_email" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-image"></i> Upload Your Picture</td>
					   			<td><input type="file" name="u_img" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-address-card"></i> Enter Your Address</td>
					   			<td><textarea name="u_add"></textarea></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-globe"></i> Enter Your Country</td>
					   			<td><input type="text" name="u_country" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-flag"></i> Enter Your State</td>
					   			<td><input type="text" name="u_state" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-barcode"></i> Enter Your Postal Code</td>
					   			<td><input type="text" name="u_pin" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-calendar"></i> Enter Date Of Birth</td>
					   			<td><input type="date" name="u_date" /></td>
					   		</tr>
					   		<tr>
					   			<td><i class="fa fa-phone"></i> Enter Your Phone</td>
					   			<td><input type="tel" name="u_phone" /></td>
					   		</tr>
					   	</table>
					   	<center>
					   		<input type="submit" name="u_signup" value="Sign Up">
					   		<input type="reset" name="reset" value="Reset">
					   	</center>
					   </form>
					</li>
						<li><a href="#"><i class="fa fa-sign-in"></i> Login</a>
							<form method="post" style="margin-left: -460px;" enctype="multipart/form-data">
								<table>
									<tr>
										<td><i class="fa fa-envelope-square"></i>  Enter Your Email </td>
										<td> <input type="email" name="email_login" /></td>
									</tr>
									<tr>
										<td><i class="fa fa-key"></i> Enter Your Password</td>
										<td><input type="password" name="pass_login" /></td>
									</tr>
								</table>
								<center>
									<input type="submit" name="login_btn" value="Login" />
									<input type="button" name="for_pass" value="Forget Password" />
								</center>

							</form>
						</li>
			</ul>
</div>
<div id="search">
	<form method="get" action="search.php" enctype="multipart/form-data">
		<input type="text" name="user_query" placeholder="search From Here...">
		<button name='search' id="search_btn"><i class="fa fa-search-plus"></i> Search</button>
		<button id="cart_btn"><a href="cart.php"><i class="fa fa-cart-arrow-down"></i> Cart <i class="fa fa-arrow-circle-down"></i> <?php cart_count(); ?> </a></button>
		
	</form>
	</div> 
</div>