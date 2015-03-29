var template = require('../../../_hbs/bandScoring.hbs');
var Rating = require('../models/Rating.js');
var BandRatingView = Backbone.View.extend({ 

	template: template,
	tagName: 'div',
	className: 'detail',

	events: {
		
	},

	empty: function(){
		$('.container').empty();
	},

	render: function(){ 
		this.empty();
		this.$el.html(this.template());
		this.$container = this.$el.find('.container');

		return this;
	}

});

module.exports = BandRatingView;