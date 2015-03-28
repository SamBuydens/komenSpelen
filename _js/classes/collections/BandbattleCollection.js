var Bandbattle = require('../models/Bandbattle.js');

var BandbattleCollection = Backbone.collection.extend({

	model: Bandbattle,
	url: 'api/bandbattles/',

	// Collection logica & methods

});

module.exports = BandbattlesCollection;