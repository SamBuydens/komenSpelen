var Rating = require('../models/Rating.js');

var RatingsCollection = Backbone.collection.extend({

	model: Rating,
	url: 'api/bands/',

	// Collection logica & methods

});

module.exports = RatingCollection;