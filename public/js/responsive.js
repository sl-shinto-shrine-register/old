// Common

window.onload = responsive;
window.onresize = responsive;

function responsive () {
	toggleHeader ();
	toggleMenuButton ();
}

// Header

var headerCaption = null;

function toggleHeader () {
	if (headerCaption == null) {
		headerCaption = document.getElementsByTagName("h1")[0].innerHTML
	}
	if ((window.innerHeight > window.innerWidth)) {
		document.getElementsByTagName("h1")[0].innerHTML = "SLSR";
	} else {
		document.getElementsByTagName("h1")[0].innerHTML = headerCaption;
	}
}

// Menu

function toggleMenuButton () {
	// Detect menu button
	var menuButton = document.getElementById("menuButton");
	// Display mode
	if ((window.innerHeight > window.innerWidth)) {
		// Add menu button
		if (menuButton == null) {
			menuButton = document.createElement("div");
			menuButton.setAttribute("id", "menuButton");
			menuButton.setAttribute("onClick", "toggleMenu(this)");
			menuButton.setAttribute("title", document.getElementById("nav").getAttribute("title"));
			var menuButtonBar = document.createElement("div");
			menuButton.appendChild(menuButtonBar);
			menuButton.appendChild(menuButtonBar.cloneNode());
			menuButton.appendChild(menuButtonBar.cloneNode());
			document.getElementsByTagName("header")[0].appendChild(menuButton);

		}
		// Hide menu by default
		document.getElementsByTagName('nav')[0].style.display = "none";
	} else {
		if (menuButton != null) {
			document.getElementsByTagName("header")[0].removeChild(menuButton);
		}
		// Show menu by default
		document.getElementsByTagName('nav')[0].style.display = "block";
	}
}

function toggleMenu (button) {
	// Detect navigation
	var nav = document.getElementsByTagName('nav')[0];
	// Detect menu button
	var menuButton = document.getElementById("menuButton");
	if (nav.style.display == "none") {
		nav.style.display = "block";
		menuButton.className = "active";
	} else {
		nav.style.display = "none";
		menuButton.className = "";
	}
}
