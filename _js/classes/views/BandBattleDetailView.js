var template = require('../../../_hbs/bandbattleDetail.hbs');
var inviteTemplate = require('../../../_hbs/organiseInvitations.hbs');
var BandBattle = require('../models/BandBattle.js');
var BandbattleDetailView = Backbone.View.extend({ 

	template: template,
	inviteTemplate: inviteTemplate,
	tagName: 'div',
	className: 'detail',

	events: {
		'click .send-invite-btn': 'sendInvite',
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
				}
			}.bind(this)
		});
	},

	sendInvite: function(){
		var mail = $(".email").val();
		$.post(window.www_root+"api/bandbattles/"+this.model.attributes.id+"/invites/sendcode/", { email: mail }).done(function(bandbattledata){
			Window.Application.navigate("bandbattles/"+bandbattledata.id);
		}.bind(this));
		console.log("[BandBattleDetailView] Sent invite to: "+mail);
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