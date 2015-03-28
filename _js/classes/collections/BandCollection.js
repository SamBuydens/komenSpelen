var Band = require('../models/Band.js');

var BandsCollection = Backbone.collection.extend({

	model: Band,
	url: 'api/bands/',

	// Collection logica & methods

});

module.exports = BandCollection;