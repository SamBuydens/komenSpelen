var template = require('../../../_hbs/bandbattleDetail.hbs');
var inviteTemplate = require('../../../_hbs/organiseInvitations.hbs');
var createEventTemplate = require('../../../_hbs/acceptInvitation.hbs');
var BandBattle = require('../models/BandBattle.js');
var BandbattleDetailView = Backbone.View.extend({ 

	template: template,
	inviteTemplate: inviteTemplate,
	createEventTemplate: createEventTemplate,
	tagName: 'article',
	className: 'bandbattle-detail',

	events: {
		'click .send-invite-btn': 'sendInvite',
		'click .accept-invite-btn': 'acceptInvite',
	},

	empty: function(){
		$('.container').empty();
	},

	initialize: function(id){ console.log('[BandBattleDetailView] Fetching bandbattle model for id: ' + id);
		this.model = new BandBattle();
		this.model.set('id', id);
		this.model.fetch({
			success: function(model, response){
				if(response.length !== 0){
					this.checkOrganizer();
					this.checkInvited();
				}
			}.bind(this)
		});
	},

	checkInvited: function(){
		if(window.invite_code !== undefined){
			console.log("[BandBattleDetailView] Accept invitation?");
			this.$el.find('.invite').append(this.createEventTemplate());
		}
	},

	acceptInvite: function(){
		console.log("[BandBattleDetailView] Accepted the invitation and created event");

		var gigdate = "2015-03-30";
		var loc = $(".location").val();
		var lat = $(".latitude").val();
		var lon = $(".longitude").val();

		$.post(window.www_root+"api/bandbattles/"+bandbattledata.id+"/events/", { host_id: window.user_id, gig_date: this.gigdate, location: this.loc, latitude: this.lat, longitude: this.lon }).done(function(eventdata){
			Window.Application.navigate("bandbattles/"+bandbattledata.id, { trigger:true });
		}.bind(this));

	},

	sendInvite: function(){
		if($(".email").val()){
			var mail = $(".email").val();

			$.post(window.www_root+"api/bandbattles/"+this.model.attributes.id+"/invites/sendcode/", { email: mail }).done(function(bandbattledata){
				//Window.Application.navigate("bandbattles/"+bandbattledata.id, {trigger: true});
			}.bind(this));

			console.log("[BandBattleDetailView] Sent invite to: " + mail);
		}
	},

	checkOrganizer: function(){
		if(window.user_id === this.model.attributes.organiser_id){
			console.log("[BandBattleDetailView] Organisers can invite bands via email.");
			this.$el.find('.invite').append(this.inviteTemplate());
		}
	},

	render: function(){ 
		this.empty();
		this.$el.html(this.template());
		this.$container = this.$el.find('.container');

		return this;
	}

});

module.exports = BandbattleDetailView;