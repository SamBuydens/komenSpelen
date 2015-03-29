var BandbattleCreateView = require('../views/BandbattleCreateView.js');
var BandBattleDetailView = require('../views/BandBattleDetailView.js');

var Application = Backbone.Router.extend({

	routes: {
		"bandbattles/:id": "bandBattleDetailScreen",
		"bandbattleCreate": "createBandbattleScreen", 
		"bandbattleEvents/:id/ratings": "bandRatingScreen",
		"bandbattles/:id/live": "bandbattleLiveScreen",
		"bands/:id": "bandDetailScreen",
		"*actions": "default"
	},

	invite_code: undefined,

	empty: function(){ console.log("[Application] empty");
		$('.container').empty();
	},

	bandBattleDetailScreen: function(id){ console.log("[Application] bandBattleDetailScreen (id:"+id+")"); this.checkUserLogin();
		this.empty();
		this.bandBattleDetailView = new BandBattleDetailView(id);
		$('.container').append(this.bandBattleDetailView.render().el);
	},

	createBandbattleScreen: function(){ console.log("[Application] Create Bandbattle Screen"); this.checkUserLogin();
		this.empty();
		this.createView = new BandbattleCreateView();
		$('.container').append(this.createView.render().el);
	},

	bandbattleLiveScreen: function(id){ console.log("[Application] bandbattleLiveScreen (id:"+id+")"); this.checkUserLogin();

	},

	bandRatingScreen: function(id){ console.log("[Application] bandRatingScreen (id:"+id+")"); this.checkUserLogin();

	},

	bandDetailScreen: function(id){ console.log("[Application] bandDetailScreen (id:"+id+")"); this.checkUserLogin();

	},

	default : function(){ console.log("[Application] default"); this.checkUserLogin(); 
		
		this.checkInvitationCode();

	},

	checkUserLogin: function(){
		if(typeof window.user_id !== 'undefined'){
			$.get(window.www_root+"api/bands/"+window.user_id+"/").done(function(userdata){
				if(typeof userdata.id === "undefined"){
					window.location = window.www_root+"?p=login";
				}
			}.bind(this));
		}else{
			window.location = window.www_root+"?p=login";
		}
	}, 

	checkInvitationCode: function(){
		if(window.invite_code !== undefined){ console.log(window.invite_code);
			$.get(window.www_root+"api/bandbattles/invites/checkcode/"+window.invite_code+"/").done(function(invitedata){
				if(invitedata.bandbattle_id !== undefined){ console.log(invitedata.bandbattle_id);
					this.navigate("bandbattles/"+invitedata.bandbattle_id, {trigger: true});
				}else{
					window.invite_code = undefined;
					this.navigate("bandbattleCreate", {trigger: true});
				}
			}.bind(this));
		}else{
			this.navigate("bandbattleCreate", {trigger: true});
		}
	}

});

module.exports = Application;