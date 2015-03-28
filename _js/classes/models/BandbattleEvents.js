var BandbattleEvent = Backbone.Model.extend({
	
	defaults: {
		"id": 0, 
		"bandbattle_id": 0, 
		"host_id": 0, 
		"gig_date": "", 
		"location": "", 
		"latitude": 0, 
		"longitude": 0
	}

});

module.exports = BandbattleEvent;