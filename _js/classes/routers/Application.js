//var OverviewView = require('../views/OverviewView.js');
//var StudentDetailView = require('../views/StudentDetailView.js');

var Application = Backbone.Router.extend({

	routes: {
		"bandbattles": "bandbattles",
		"*actions": "default"
	},

	empty: function(){
		$('.container').empty();
	},

	default : function(){
		this.navigate("bandbattles", {trigger: true});
	}/*,

	overview: function(){
		this.empty();
		this.overview = new OverviewView();
		$('.container').append(this.overview.render().el);
	},*/

});

module.exports = Application;