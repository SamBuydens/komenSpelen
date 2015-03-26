var Handlebars = require("hbsfy/runtime");
var Application = require("./classes/routers/Application.js");
//var FeedbackCollection = require("./classes/collections/FeedbackCollection.js");

function init() {
	Window.Application = new Application();
	Backbone.history.start();

	/*var collection = new FeedbackCollection({
		student_id: 1
	});
	collection.fetch();*/
}

init();