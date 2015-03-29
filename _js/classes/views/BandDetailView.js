var template = require('../../../_hbs/bandDetail.hbs');
var Band = require('../models/Band.js');
var BandDetailView = Backbone.View.extend({ 

	template: template,
	tagName: 'article',
	className: 'band-detail',

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

module.exports = BandDetailView;