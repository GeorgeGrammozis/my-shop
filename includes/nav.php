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

	<div class="login-screen">
		<h1>Login form</h1>
	</div>
	<div class="register-screen">
		<h1>Register form</h1>
	</div>
	
	<!-- THE MAIN NAVIGATION ---------------------------------------------------------- -->
	<!-- ------------------------------------------------------------------------------ -->
	
	<nav class="page"> <!-- display flex -->
		<div class="left">
			<?php echo BRAND_NAME; ?>
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
</div>