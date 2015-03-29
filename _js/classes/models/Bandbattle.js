var Bandbattle = Backbone.Model.extend({
	
	urlRoot: window.www_root+"api/bandbattles/",

	defaults: {
		"id": 0,
		"organiser_id": 0,
		"name": "",
		"gigs": [],
		"organiser": {},
		"images": []
	},

	methodUrl: function(method){
		if(method === "read" && this.bandbattle_id){
			this.url = window.www_root+"/api/bandbattles/"+this.bandbattle_id;
			return;
		}
		this.url = window.www_root+"/api/bandbattles/";
	}

});

module.exports = Bandbattle;