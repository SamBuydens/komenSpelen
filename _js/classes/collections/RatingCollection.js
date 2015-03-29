var Rating = require('../models/Rating.js');

var RatingsCollection = Backbone.collection.extend({

	model: Rating,
	url: 'api/ratings/',

	// Collection logica & methods

});

module.exports = RatingCollection;