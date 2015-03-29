var template = require('../../../_hbs/bandbattleCreate.hbs');

var BandbattleCreateView = Backbone.View.extend({

	template: template,
	tagName: 'div',
	className: 'overview',

	events: {
		'click .create-battle-btn': 'createBandbattle'
	},

	createBandbattle: function(e){ console.log('createBandbattle');
		e.preventDefault();
		$.post(window.www_root+"api/bandbattles/", { organiser_id: window.user_id }).done(function(bandbattledata){
			Window.Application.navigate("bandbattles/"+bandbattledata.id);
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