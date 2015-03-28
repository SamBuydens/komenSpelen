var Image = Backbone.Model.extend({
	
	defaults: {
		"id": 0, 
		"bandbattle_id": 0, 
		"uploader_id": 0, 
		"filename": "", 
		"width": 0,
		"height": 0
	}

});

module.exports = Image;