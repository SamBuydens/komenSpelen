var Bandmember = Backbone.Model.extend({
	
	defaults: {
		"id": 0,
		"band_id": 0,
		"name": "",
		"instrument": "",
		"image": ""
	}

});

module.exports = Bandmember;