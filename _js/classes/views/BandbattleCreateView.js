var template = require('../../../_hbs/bandbattleCreate.hbs');

var BandbattleCreateView = Backbone.View.extend({

	template: template,
	tagName: 'div',
	className: 'overview',

	events: {
		'click .create-battle-btn': 'createBandbattle'
	},

	createBandbattle: function(e){ console.log('[bandbattleCreateView] Creating Bandbattle');
		e.preventDefault();
		window.invite_code = undefined;

		$.post(window.www_root+"api/bandbattles/", { organiser_id: window.user_id }).done(function(bandbattledata){

			var d = new Date();

			this.gigdate = $(".gigdate").val();
			this.loc = $(".location").val();
			this.lat = $(".latitude").val(); 
			this.lon = $(".longitude").val(); 

			$.post(window.www_root+"api/bandbattles/"+bandbattledata.id+"/events/", { host_id: window.user_id, gig_date: this.gigdate, location: this.loc, latitude: this.lat, longitude: this.lon }).done(function(eventdata){
				Window.Application.navigate("bandbattles/"+bandbattledata.id, { trigger:true });
			}.bind(this));

		}.bind(this));

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

module.exports = BandbattleCreateView;