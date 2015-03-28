var BandbattlesOverviewView = require('../views/BandbattlesOverviewView.js');

var Application = Backbone.Router.extend({

	routes: {
		"bandbattles": "bandbattlesScreen",
		"bandbattles/:id": "bandbattleDetailScreen",
		"bandbattleCreate": "createBandbattleScreen", 
		"bandbattleEvents/:id": "bandbattleEventScreen", 
		"bandbattleEvents/:id/ratings": "bandRatingScreen",
		"bands/:id": "bandDetailScreen",
		"bands/:id/members": "bandMembersScreen",
		"*actions": "default"
	},

	empty: function(){
		$('.container').empty();
	},

	bandbattlesScreen: function(){

	},

	bandbattlesDetailsScreen: function(){

	},

	createBandbattleScreen: function(){

	},

	bandbattleEventScreen: function(){

	},

	bandRatingScreen: function(){

	},

	bandDetailScreen: function(){

	},

	bandMembersScreen: function(){

	},

	default : function(){
		this.navigate("bandbattles", {trigger: true});
	}

});

module.exports = Application;