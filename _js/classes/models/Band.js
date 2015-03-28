var Band = Backbone.Model.extend({
	
	defaults: {
		"id": 0,
		"bandname": "",
		"email": "",
		"band_image": "",
		"role_id": 0,
		"members": []
	}

});

module.exports = Band;