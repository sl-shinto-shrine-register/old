function addMenuOpenButton() {
	/* Create menu button container */
	var menuButtonContainer = document.createElement("div");
	menuButtonContainer.setAttribute("id", "portrait-menu-button");
	menuButtonContainer.setAttribute("onClick", "openPortraitMenu(this);");
	/* Create menu button */
	var menuButton = document.createElement("div");
	/* Create menu button caption */
	var menuButtonCaption = document.createElement("div");
	menuButton.appendChild(menuButtonCaption);
	menuButton.appendChild(menuButtonCaption.cloneNode());
	menuButton.appendChild(menuButtonCaption.cloneNode());
	menuButtonContainer.appendChild(menuButton);
	/* Add menu button container to document */
	document.getElementsByTagName("header")[0].appendChild(menuButtonContainer);
}

function addMenuCloseButton() {
	/* Create menu button container */
	var menuButtonContainer = document.createElement("div");
	menuButtonContainer.setAttribute("id", "portrait-menu-button");
	menuButtonContainer.setAttribute("onClick", "closePortraitMenu(this);");
	/* Create menu button */
	var menuButton = document.createElement("div");
	/* Create menu button caption */
	var menuButtonCaption = document.createElement("span");
	menuButtonCaption.appendChild(document.createTextNode("X"));
	menuButton.appendChild(menuButtonCaption);
	menuButtonContainer.appendChild(menuButton);
	/* Add menu button container to document */
	document.getElementsByTagName("header")[0].appendChild(menuButtonContainer);
}

function removeMenuButton() {
	var menuButton = document.getElementById("portrait-menu-button");
	if (menuButton != null) {
		document.getElementsByTagName("header")[0].removeChild(menuButton);
	}
}

/* Add and remove menu button for screen in portrait mode */
function portraitMenuButton () {
	if (window.innerHeight > window.innerWidth){
		/* Add menu open button */
		addMenuOpenButton();
	} else {
		/* Remove menu button */
		removeMenuButton();
	}
}

function openPortraitMenu(button) {
	/* Change menu button */
	removeMenuButton();
	addMenuCloseButton();
	/* Show menu */
	document.getElementsByTagName('nav')[0].style.display = 'block';
}

function closePortraitMenu(button) {
	/* Change menu button */
	removeMenuButton();
	addMenuOpenButton();
	/* Hide menu */
	document.getElementsByTagName('nav')[0].style.display = 'none';
}
