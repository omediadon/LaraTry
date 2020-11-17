require("./bootstrap");

window.moment = require("moment-timezone");

require("../views/lbc/assets/js/app");

/**
 *
 * @param {string} selector
 * @param {string} message
 * @param {string} alerttype
 * @param {number} timeout
 */
window.showAlert = (selector, message, alerttype, timeout) => {
	if(timeout === undefined){
		timeout = 5000;
	}

	let rand = Math.floor(Math.random() * 10000);
	let id   = "alertdiv" + rand;

	let html = "<div id='" + id + "' class='alert alert-" + alerttype + " alert-dismissible fade show'>" + message + "  <button" + " type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span> </button></div>";

	$(selector)
		.html(html);

	if(timeout > 0){
		setTimeout(function(){
			$("#" + id)
				.remove();
		}, timeout);
	}
};
