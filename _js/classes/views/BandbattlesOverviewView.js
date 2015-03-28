var template = require('../../../_hbs/bandbattlesoverview.hbs');

var BandbattlesOverviewView = Backbone.View.extend({

	template: template,
	tagName: 'div',
	className: 'overview',

	events: {
		'click .create': 'createBandbattle',
	},

	clickAdd: function(e){

		e.preventDefault();

		// code

	}


});

module.exports = BandbattlesOverviewView;