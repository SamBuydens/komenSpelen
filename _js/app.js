var Handlebars = require("hbsfy/runtime");
var Application = require("./classes/routers/Application.js");

function init() { console.log("[app] init");

	Window.Application = new Application();
	Backbone.history.start();

	// Assure cookie embedding in all api calls
	var csrf = readCookie("X-CSRF-Token");
 	if (csrf) {
    	Window.Application.originalSync = Backbone.sync;
    	Backbone.sync = function(method, model, options) {
        	options || (options = {});
        	options.headers = { "X-CSRF-Token": csrf };
        	return Window.Application.originalSync(method,model,options);
    	};
 	}

}

// --- Cookie Management ------------------------------
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

init();