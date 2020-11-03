<div class="nav-wrap"> 
	
	<!-- THE OVERLAY AND MOBILE SIDEBAR ------------------------------------------ -->
	<!-- ------------------------------------------------------------------------- -->
	
	<div onclick="closeModals(this, 'mobile-nav')" class="overlay">
	</div>	
	<div class="mobile-nav"> 
		<a class="brand"><?php echo BRAND_NAME; ?></a>
		<a href="index.php"><i class="fas fa-home"></i> ΠΡΟΪΟΝΤΑ</a>
		<a href="contact.php"><i class="fas fa-envelope"></i> ΕΠΙΚΟΙΝΩΝΙΑ </a>
		<a onclick="showLoginScreen()" ><i class="fas fa-sign-in-alt"></i> ΣΥΝΔΕΣΗ </a>
		<a onclick="showRegisterScreen()" ><i class="fas fa-user"></i> ΔΗΜΙΟΥΡΓΙΑ ΛΟΓΑΡΙΑΣΜΟΥ </a>
	</div>

	<!-- THE MAIN NAVIGATION ---------------------------------------------------------- -->
	<!-- ------------------------------------------------------------------------------ -->
	
	<nav class="page"> <!-- display flex -->
		<div class="left">
			<a class="brand"><?php echo BRAND_NAME; ?></a>
		</div>

		<div class="right">
			<div class="middle"> 
				<a href="index.php"><i class="fas fa-home"></i> ΠΡΟΪΟΝΤΑ</a>
				<a href="contact.php"><i class="fas fa-envelope"></i> ΕΠΙΚΟΙΝΩΝΙΑ </a>
				<a onclick="showLoginScreen()" ><i class="fas fa-sign-in-alt"></i> ΣΥΝΔΕΣΗ </a>
				<a onclick="showRegisterScreen()" ><i class="fas fa-user"></i> ΔΗΜΙΟΥΡΓΙΑ ΛΟΓΑΡΙΑΣΜΟΥ </a>
			</div>
			
			<div class="icons"> <!-- display flex -->
				<div onclick="showCart()" class="cartItems">
					<i class="fas fa-shopping-cart"></i>
					<span class="nav-badge">0</span> <!-- !!! Js className, do not modify -->
				</div>
				
				<div onclick="showSideBar()">
					<i class="fas fa-bars"></i> 
				</div>
			</div>
		</div>
	</nav>

	<!-- THE MODALS TRIGGERED FROM THE NAVBAR ----------------------------------------- -->
	<!-- ------------------------------------------------------------------------------ -->
	
	<!-- the login screen -->
	<div class="login-screen">
		<?php include "html/login-form.php"; ?>
	</div>

	<!-- the register screen -->
	<div class="register-screen">
		<?php include "html/register-form.php"; ?>
	</div>
		
	<!-- the cart screen -->
	<div class="cart-screen">
		<?php include "html/sidecart.php"; ?>
	</div>	

</div>