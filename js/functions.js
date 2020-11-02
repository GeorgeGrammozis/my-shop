let phpScript = '../php/functions.php';

/* The overlay that covers the screen when a modal or the sidenav is displayed */
let overlay = document.querySelector(".overlay");

let mobileNav = document.querySelector(".mobile-nav");

let loginScreen = document.querySelector(".login-screen");

let registerScreen = document.querySelector(".register-screen");

/* The array of modals to loop through and close any open modal */
let modalsArray = ['mobile-nav', 'login-screen', 'register-screen'];

/**
 * Displaying the mobile navigation side bar.
 * @return none;
 */
function showSideBar(){
	overlay.style.display = "block";
	mobileNav.style.transform = 'translateX(0)';
}

/**
 * Closing a modal and the overlay on screen when the user clicks on the overlay.
 * @param  {element} overlay [ the overlay element ]
 * @param  {string} element [the modal to close. i.e 'mobile-nav' (not a classname)]
 * @return {none}
 */
function closeModals(overlay, element){
	for(let modal of modalsArray){
		
		if(modal == "mobile-nav"){
			mobileNav.style.transform = 'translateX(-120%)';
		}

		if(modal == "login-screen" || modal == "register-screen"){
			loginScreen.style.transform = 'translateX(100%)';
			registerScreen.style.transform = 'translateX(100%)';
		}
	}

	overlay.style.opacity = 0;
	setTimeout(() => {
		overlay.style.display = "none";
		overlay.style.opacity = 1;
	}, 200);
}

/**
 * [showLoginScreen description]
 * @return {[type]} [description]
 */
function showLoginScreen(){
	mobileNav.style.transform = 'translateX(-120%)';
	overlay.style.display = "block";
	loginScreen.style.display = 'block';
	loginScreen.style.transform = 'translateX(0)';
}

/**
 * [showLoginScreen description]
 * @return {[type]} [description]
 */
function showRegisterScreen(){
	mobileNav.style.transform = 'translateX(-120%)';
	overlay.style.display = "block";
	registerScreen.style.display = 'block';
	registerScreen.style.transform = 'translateX(0)';
}

function showCart(){

}