let phpScript = '../php/functions.php';

// The overlay that covers the screen when a modal or the sidenav is displayed 
let overlay = document.querySelector(".overlay");

// The mobile nav element (modal sidenav)
let mobileNav = document.querySelector(".mobile-nav");

// The login modal element
let loginScreen = document.querySelector(".login-screen");

// The register modal element
let registerScreen = document.querySelector(".register-screen");

// The cart modal element
let cartScreen = document.querySelector(".cart-screen");

// The array of modals to loop through and close any open modal 
let modalsArray = ['mobile-nav', 'login-screen', 'register-screen', 'cart-screen'];


/**
 * Displaying the mobile navigation side bar.
 * @return none;
 */
function showSideBar(){
	overlay.style.display = "block";
	mobileNav.style.transform = 'translateX(0)';
}


/**
 * displays the login modal
 * @return none
 */
function showLoginScreen(){
	mobileNav.style.transform = 'translateX(-120%)';
	overlay.style.display = "block";
	loginScreen.style.display = 'block';
	loginScreen.style.transform = 'translateX(0)';
}


/**
 * display the register modal
 * @return none
 */
function showRegisterScreen(){
	mobileNav.style.transform = 'translateX(-120%)';
	overlay.style.display = "block";
	registerScreen.style.display = 'block';
	registerScreen.style.transform = 'translateX(0)';
}


/**
 * display the cart modal
 * @return none
 */
function showCart(){
	mobileNav.style.transform = 'translateX(-120%)';
	overlay.style.display = "block";
	cartScreen.style.display = 'block';
	cartScreen.style.transform = 'translateX(0)';
}


/**
 * Closing a modal and the overlay on screen when the user clicks on the overlay.
 * @param  {element} overlay -> the overlay element
 * @param  {string} element -> the modal to close. i.e 'mobile-nav' (not a classname)
 * @return {none}
 */
function closeModals(overlay, element){
	
	for(let modal of modalsArray){
		if(modal == "mobile-nav"){
			mobileNav.style.transform = 'translateX(-120%)';
		}

		if(modal == "login-screen" || modal == "register-screen" || modal == "cart-screen"){
			loginScreen.style.transform = 'translateX(100%)';
			registerScreen.style.transform = 'translateX(100%)';
			cartScreen.style.transform = 'translateX(100%)';
		}
	}

	overlay.style.opacity = 0;
	setTimeout(() => {
		overlay.style.display = "none";
		overlay.style.opacity = 1;
	}, 200);
}
