var Bandbattle = Backbone.Model.extend({
	
	defaults: {
		"id": 0,
		"organiser_id": 0,
		"name": "",
		"gigs": [],
		"organiser": {},
		"images": []
	}

});

module.exports = Bandbattle;