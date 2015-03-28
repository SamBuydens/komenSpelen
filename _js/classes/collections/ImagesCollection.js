var Image = require('../models/Image.js');

var ImageCollection = Backbone.collection.extend({

	model: Image,
	url: 'api/bandmembers/',

	// Collection logica & methods

});

module.exports = ImageCollection;