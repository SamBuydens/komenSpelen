var Rating = Backbone.Model.extend({
	
	defaults: {
		"id": 0, 
		"quota_id": 0, 
		"rated_id": 0, 
		"rater_id": 0, 
		"score": 0, 
		"quota": "", 
		"band_playing": {},
		"band_rated": {}
	}

});

module.exports = Rating;