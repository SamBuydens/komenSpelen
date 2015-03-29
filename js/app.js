/* 
- KomenSpelen 
- Battle of Bands 
- v1.0.0 
- MIT licensed 
- Copyright (C) 2015 Thorr Stevens & Sam Buydens 
*/

(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var Handlebars = require("hbsfy/runtime");
var Application = require("./classes/routers/Application.js");

function init() { console.log("[app] init");

	Window.Application = new Application();
	Backbone.history.start();

	// Assure cookie embedding in all api calls
	var csrf = readCookie("X-CSRF-Token");
 	if (csrf) {
    	Window.Application.originalSync = Backbone.sync;
    	Backbone.sync = function(method, model, options) {
        	options || (options = {});
        	options.headers = { "X-CSRF-Token": csrf };
        	return Window.Application.originalSync(method,model,options);
    	};
 	}

}

// --- Cookie Management ------------------------------
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

init();
},{"./classes/routers/Application.js":11,"hbsfy/runtime":23}],2:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<header>\n	<h1>Accept Invite</h1>\n</header>\n\n<input type=\"text\" name=\"location\" class=\"location\" placeholder=\"Event Location\"/>\n<input type=\"hidden\" name=\"latitude\" class=\"latitude\" value=\"51.182845\"/>\n<input type=\"hidden\" name=\"longitude\" class=\"longitude\" value=\"3.581908\"/>\n<button name=\"accept invite\" class=\"accept-invite-btn\">\n	Accept Invite\n</button>";
  },"useData":true});

},{"hbsfy/runtime":23}],3:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<section>\n	<header>\n		<h1>adres</h1>\n	</header>\n	<span>\n		<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5034.092941226263!2d4.319042444458007!3d50.88585026523365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c3eea4dee6f9%3A0x7fff6026e637a25d!2sJette!5e0!3m2!1snl!2sbe!4v1427625353303\" width=\"260\" height=\"140\" frameborder=\"0\" style=\"border:0\"></iframe>\n	</span>\n	<p>\n		ergensstraat 12\n		3500 Hasselt\n	</p>\n</section>\n<ul id=\"detail-nav\">\n	<li>\n		<svg viewBox=\"0 0 20 20\"><use xlink:href=\"images/iconen/bio.svg\"></use></svg>\n		<p>leden</p>\n	</li>\n	<li>\n		<p>\n			maps\n		</p>\n	</li>\n	<li>\n		<p>\n			bio\n		</p>\n	</li>\n	<li>\n		<p>\n			foto's\n		</p>\n	</li>\n	<li>\n		<p>\n			commentaar\n		</p>\n	</li>\n</ul>";
  },"useData":true});

},{"hbsfy/runtime":23}],4:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<article id=\"score\">\n	<section>\n		<header>\n			<h1>score: evil invaders</h1>\n		</header>\n		<span>\n			<span class=\"handjeuhs\">\n				 <span class=\"handjeuh\">\n\n				 </span>\n			</span>\n			<span class=\"slider\">\n				<span class=\"slider-fill\">\n					\n				</span>\n			</span>\n			<p>\n				criteria\n			</p>\n			<p class=\"score\">\n				0\n			</p>\n		</span>\n		<span>\n			<span class=\"handjeuhs\">\n				 <span class=\"handjeuh\">\n\n				 </span>\n			</span>\n			<span class=\"slider\">\n				<span class=\"slider-fill\">\n					\n				</span>\n			</span>\n			<p>\n				criteria\n			</p>\n			<p class=\"score\">\n				0\n			</p>\n		</span>\n		<span>\n			<span class=\"handjeuhs\">\n				 <span class=\"handjeuh\">\n\n				 </span>\n			</span>\n			<span class=\"slider\">\n				<span class=\"slider-fill\">\n					\n				</span>\n			</span>\n			<p>\n				criteria\n			</p>\n			<p class=\"score\">\n				0\n			</p>\n		</span>\n		<button class=\"btn\" type=\"button\">toekennen</button> \n	</section>\n</article>";
  },"useData":true});

},{"hbsfy/runtime":23}],5:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<h1>No bandbattle joined:</h1>\n<h3>Create Bandbattle & Event?</h3>\n\n<input type=\"text\" name=\"location\" class=\"location\" placeholder=\"Event Location\"/>\n<input type=\"hidden\" name=\"latitude\" class=\"latitude\" value=\"51.182845\"/>\n<input type=\"hidden\" name=\"longitude\" class=\"longitude\" value=\"3.581908\"/>\n<input type=\"date\" name=\"date\" class=\"gigdate\" placeholder=\"Event Date\"/>\n<button name=\"create bandbattle\" class=\"create-battle-btn\">\n	Create Bandbattle\n</button>";
  },"useData":true});

},{"hbsfy/runtime":23}],6:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<header>\n	<h1>Your Bandbattle</h1>\n</header>\n\n<section class=\"invite\">\n	\n</section>\n\n<section class=\"bandEvents\">\n	\n</section>";
  },"useData":true});

},{"hbsfy/runtime":23}],7:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<header>\n	<h1>Send Invites</h1>\n</header>\n\n<input type=\"email\" name=\"email\" class=\"email\" placeholder=\"e-mail adress\"/>\n<button name=\"send invite\" class=\"send-invite-btn\">\n	Send Invite\n</button>";
  },"useData":true});

},{"hbsfy/runtime":23}],8:[function(require,module,exports){
var Band = Backbone.Model.extend({
	
	defaults: {
		"id": 0,
		"bandname": "",
		"band_image": "",
		"role_id": 0,
		"members": []
	}

});

module.exports = Band;
},{}],9:[function(require,module,exports){
var Bandbattle = Backbone.Model.extend({
	
	urlRoot: window.www_root+"api/bandbattles/",

	defaults: {
		"id": 0,
		"organiser_id": 0,
		"name": "",
		"gigs": [],
		"organiser": {},
		"images": []
	},

	methodUrl: function(method){
		if(method === "read" && this.bandbattle_id){
			this.url = window.www_root+"/api/bandbattles/"+this.bandbattle_id;
			return;
		}
		this.url = window.www_root+"/api/bandbattles/";
	}

});

module.exports = Bandbattle;
},{}],10:[function(require,module,exports){
var Rating = Backbone.Model.extend({
	
	defaults: {
		"id": 0, 
		"quota_id": 0, 
		"rated_id": 0, 
		"rater_id": 0, 
		"score": 0, 
		"quota": "", 
		"band_playing": {},
		"band_rated": {}
	}

});

module.exports = Rating;
},{}],11:[function(require,module,exports){
var BandbattleCreateView = require('../views/BandbattleCreateView.js');
var BandBattleDetailView = require('../views/BandBattleDetailView.js');
var BandDetailView = require('../views/BandDetailView.js');
var BandRatingView = require('../views/BandRatingView.js');

var Application = Backbone.Router.extend({

	routes: {
		"bandbattles/:id": "bandBattleDetailScreen",
		"bandbattleCreate": "createBandbattleScreen", 
		"bandbattleEvents/:id/ratings": "bandRatingScreen",
		"bandbattles/:id/live": "bandbattleLiveScreen",
		"bands/:id": "bandDetailScreen",
		"*actions": "default"
	},

	invite_code: undefined,

	empty: function(){ console.log("[Application] empty");
		$('.container').empty();
	},

	bandBattleDetailScreen: function(id){ console.log("[Application] -- bandBattleDetailScreen (id:"+id+") --------"); this.checkUserLogin();
		this.empty();
		this.bandBattleDetailView = new BandBattleDetailView(id);
		$('.container').append(this.bandBattleDetailView.render().el);
	},

	createBandbattleScreen: function(){ console.log("[Application] -- createBandbattleScreen ------"); this.checkUserLogin();
		window.invite_code = undefined;
		this.empty();
		this.createView = new BandbattleCreateView();
		$('.container').append(this.createView.render().el);
	},

	bandbattleLiveScreen: function(id){ console.log("[Application] -- bandbattleLiveScreen (id:"+id+") ------"); this.checkUserLogin();

	},

	bandRatingScreen: function(id){ console.log("[Application] -- bandRatingScreen (id:"+id+") -------"); this.checkUserLogin();
		this.empty();
		this.ratingView = new BandRatingView();
		$('.container').append(this.ratingView.render().el);
	},

	bandDetailScreen: function(id){ console.log("[Application] -- bandDetailScreen (id:"+id+") -------"); this.checkUserLogin();
		this.empty();
		this.bandDetailView = new BandDetailView();
		$('.container').append(this.bandDetailView.render().el);
	},

	default : function(){ console.log("[Application] -- Launching Default -------"); this.checkUserLogin(); 
		
		$.get(window.www_root+"api/bandbattles/for/band/"+window.user_id+"/").done(function(gigdata){
			if(typeof gigdata.bandbattle_id !== "undefined"){
				console.log("[Application] Navigating to joined bandbattle");
				this.navigate("bandbattles/"+gigdata.bandbattle_id, {trigger: true});
			}else{
				console.log("[Application] No bandbattle joined yet");
				this.checkInvitationCode();
			}
		}.bind(this));

	},

	checkUserLogin: function(){
		if(typeof window.user_id !== 'undefined'){
			$.get(window.www_root+"api/bands/"+window.user_id+"/").done(function(userdata){
				if(typeof userdata.id === "undefined"){
					window.location = window.www_root+"?p=login";
				}
			}.bind(this));
		}else{
			window.location = window.www_root+"?p=login";
		}
	}, 

	checkInvitationCode: function(){
		if(window.invite_code !== undefined){ console.log("[Application] Checking invitation code");
			$.get(window.www_root+"api/bandbattles/invites/checkcode/"+window.invite_code+"/").done(function(invitedata){
				if(invitedata.bandbattle_id !== undefined){
					console.log("[Application] Invite Code Valid: " + window.invite_code + " (Bandbattle ID: " + invitedata.bandbattle_id + ")");
					this.navigate("bandbattles/"+invitedata.bandbattle_id, {trigger: true});
				}else{
					console.log("[Application] Invite Code NOT Valid: " + window.invite_code);
					window.invite_code = undefined;
					this.navigate("bandbattleCreate", {trigger: true});
				}
			}.bind(this));
		}else{
			console.log("[Application] No invite code > Creating new bandbattle");
			this.navigate("bandbattleCreate", {trigger: true});
		}
	}

});

module.exports = Application;
},{"../views/BandBattleDetailView.js":12,"../views/BandDetailView.js":13,"../views/BandRatingView.js":14,"../views/BandbattleCreateView.js":15}],12:[function(require,module,exports){
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
},{"../../../_hbs/acceptInvitation.hbs":2,"../../../_hbs/bandbattleDetail.hbs":6,"../../../_hbs/organiseInvitations.hbs":7,"../models/BandBattle.js":9}],13:[function(require,module,exports){
var template = require('../../../_hbs/bandDetail.hbs');
var Band = require('../models/Band.js');
var BandDetailView = Backbone.View.extend({ 

	template: template,
	tagName: 'article',
	className: 'band-detail',

	events: {
		
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

module.exports = BandDetailView;
},{"../../../_hbs/bandDetail.hbs":3,"../models/Band.js":8}],14:[function(require,module,exports){
var template = require('../../../_hbs/bandScoring.hbs');
var Rating = require('../models/Rating.js');
var BandRatingView = Backbone.View.extend({ 

	template: template,
	tagName: 'div',
	className: 'detail',

	events: {
		
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

module.exports = BandRatingView;
},{"../../../_hbs/bandScoring.hbs":4,"../models/Rating.js":10}],15:[function(require,module,exports){
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
},{"../../../_hbs/bandbattleCreate.hbs":5}],16:[function(require,module,exports){
"use strict";
/*globals Handlebars: true */
var base = require("./handlebars/base");

// Each of these augment the Handlebars object. No need to setup here.
// (This is done to easily share code between commonjs and browse envs)
var SafeString = require("./handlebars/safe-string")["default"];
var Exception = require("./handlebars/exception")["default"];
var Utils = require("./handlebars/utils");
var runtime = require("./handlebars/runtime");

// For compatibility and usage outside of module systems, make the Handlebars object a namespace
var create = function() {
  var hb = new base.HandlebarsEnvironment();

  Utils.extend(hb, base);
  hb.SafeString = SafeString;
  hb.Exception = Exception;
  hb.Utils = Utils;
  hb.escapeExpression = Utils.escapeExpression;

  hb.VM = runtime;
  hb.template = function(spec) {
    return runtime.template(spec, hb);
  };

  return hb;
};

var Handlebars = create();
Handlebars.create = create;

Handlebars['default'] = Handlebars;

exports["default"] = Handlebars;
},{"./handlebars/base":17,"./handlebars/exception":18,"./handlebars/runtime":19,"./handlebars/safe-string":20,"./handlebars/utils":21}],17:[function(require,module,exports){
"use strict";
var Utils = require("./utils");
var Exception = require("./exception")["default"];

var VERSION = "2.0.0";
exports.VERSION = VERSION;var COMPILER_REVISION = 6;
exports.COMPILER_REVISION = COMPILER_REVISION;
var REVISION_CHANGES = {
  1: '<= 1.0.rc.2', // 1.0.rc.2 is actually rev2 but doesn't report it
  2: '== 1.0.0-rc.3',
  3: '== 1.0.0-rc.4',
  4: '== 1.x.x',
  5: '== 2.0.0-alpha.x',
  6: '>= 2.0.0-beta.1'
};
exports.REVISION_CHANGES = REVISION_CHANGES;
var isArray = Utils.isArray,
    isFunction = Utils.isFunction,
    toString = Utils.toString,
    objectType = '[object Object]';

function HandlebarsEnvironment(helpers, partials) {
  this.helpers = helpers || {};
  this.partials = partials || {};

  registerDefaultHelpers(this);
}

exports.HandlebarsEnvironment = HandlebarsEnvironment;HandlebarsEnvironment.prototype = {
  constructor: HandlebarsEnvironment,

  logger: logger,
  log: log,

  registerHelper: function(name, fn) {
    if (toString.call(name) === objectType) {
      if (fn) { throw new Exception('Arg not supported with multiple helpers'); }
      Utils.extend(this.helpers, name);
    } else {
      this.helpers[name] = fn;
    }
  },
  unregisterHelper: function(name) {
    delete this.helpers[name];
  },

  registerPartial: function(name, partial) {
    if (toString.call(name) === objectType) {
      Utils.extend(this.partials,  name);
    } else {
      this.partials[name] = partial;
    }
  },
  unregisterPartial: function(name) {
    delete this.partials[name];
  }
};

function registerDefaultHelpers(instance) {
  instance.registerHelper('helperMissing', function(/* [args, ]options */) {
    if(arguments.length === 1) {
      // A missing field in a {{foo}} constuct.
      return undefined;
    } else {
      // Someone is actually trying to call something, blow up.
      throw new Exception("Missing helper: '" + arguments[arguments.length-1].name + "'");
    }
  });

  instance.registerHelper('blockHelperMissing', function(context, options) {
    var inverse = options.inverse,
        fn = options.fn;

    if(context === true) {
      return fn(this);
    } else if(context === false || context == null) {
      return inverse(this);
    } else if (isArray(context)) {
      if(context.length > 0) {
        if (options.ids) {
          options.ids = [options.name];
        }

        return instance.helpers.each(context, options);
      } else {
        return inverse(this);
      }
    } else {
      if (options.data && options.ids) {
        var data = createFrame(options.data);
        data.contextPath = Utils.appendContextPath(options.data.contextPath, options.name);
        options = {data: data};
      }

      return fn(context, options);
    }
  });

  instance.registerHelper('each', function(context, options) {
    if (!options) {
      throw new Exception('Must pass iterator to #each');
    }

    var fn = options.fn, inverse = options.inverse;
    var i = 0, ret = "", data;

    var contextPath;
    if (options.data && options.ids) {
      contextPath = Utils.appendContextPath(options.data.contextPath, options.ids[0]) + '.';
    }

    if (isFunction(context)) { context = context.call(this); }

    if (options.data) {
      data = createFrame(options.data);
    }

    if(context && typeof context === 'object') {
      if (isArray(context)) {
        for(var j = context.length; i<j; i++) {
          if (data) {
            data.index = i;
            data.first = (i === 0);
            data.last  = (i === (context.length-1));

            if (contextPath) {
              data.contextPath = contextPath + i;
            }
          }
          ret = ret + fn(context[i], { data: data });
        }
      } else {
        for(var key in context) {
          if(context.hasOwnProperty(key)) {
            if(data) {
              data.key = key;
              data.index = i;
              data.first = (i === 0);

              if (contextPath) {
                data.contextPath = contextPath + key;
              }
            }
            ret = ret + fn(context[key], {data: data});
            i++;
          }
        }
      }
    }

    if(i === 0){
      ret = inverse(this);
    }

    return ret;
  });

  instance.registerHelper('if', function(conditional, options) {
    if (isFunction(conditional)) { conditional = conditional.call(this); }

    // Default behavior is to render the positive path if the value is truthy and not empty.
    // The `includeZero` option may be set to treat the condtional as purely not empty based on the
    // behavior of isEmpty. Effectively this determines if 0 is handled by the positive path or negative.
    if ((!options.hash.includeZero && !conditional) || Utils.isEmpty(conditional)) {
      return options.inverse(this);
    } else {
      return options.fn(this);
    }
  });

  instance.registerHelper('unless', function(conditional, options) {
    return instance.helpers['if'].call(this, conditional, {fn: options.inverse, inverse: options.fn, hash: options.hash});
  });

  instance.registerHelper('with', function(context, options) {
    if (isFunction(context)) { context = context.call(this); }

    var fn = options.fn;

    if (!Utils.isEmpty(context)) {
      if (options.data && options.ids) {
        var data = createFrame(options.data);
        data.contextPath = Utils.appendContextPath(options.data.contextPath, options.ids[0]);
        options = {data:data};
      }

      return fn(context, options);
    } else {
      return options.inverse(this);
    }
  });

  instance.registerHelper('log', function(message, options) {
    var level = options.data && options.data.level != null ? parseInt(options.data.level, 10) : 1;
    instance.log(level, message);
  });

  instance.registerHelper('lookup', function(obj, field) {
    return obj && obj[field];
  });
}

var logger = {
  methodMap: { 0: 'debug', 1: 'info', 2: 'warn', 3: 'error' },

  // State enum
  DEBUG: 0,
  INFO: 1,
  WARN: 2,
  ERROR: 3,
  level: 3,

  // can be overridden in the host environment
  log: function(level, message) {
    if (logger.level <= level) {
      var method = logger.methodMap[level];
      if (typeof console !== 'undefined' && console[method]) {
        console[method].call(console, message);
      }
    }
  }
};
exports.logger = logger;
var log = logger.log;
exports.log = log;
var createFrame = function(object) {
  var frame = Utils.extend({}, object);
  frame._parent = object;
  return frame;
};
exports.createFrame = createFrame;
},{"./exception":18,"./utils":21}],18:[function(require,module,exports){
"use strict";

var errorProps = ['description', 'fileName', 'lineNumber', 'message', 'name', 'number', 'stack'];

function Exception(message, node) {
  var line;
  if (node && node.firstLine) {
    line = node.firstLine;

    message += ' - ' + line + ':' + node.firstColumn;
  }

  var tmp = Error.prototype.constructor.call(this, message);

  // Unfortunately errors are not enumerable in Chrome (at least), so `for prop in tmp` doesn't work.
  for (var idx = 0; idx < errorProps.length; idx++) {
    this[errorProps[idx]] = tmp[errorProps[idx]];
  }

  if (line) {
    this.lineNumber = line;
    this.column = node.firstColumn;
  }
}

Exception.prototype = new Error();

exports["default"] = Exception;
},{}],19:[function(require,module,exports){
"use strict";
var Utils = require("./utils");
var Exception = require("./exception")["default"];
var COMPILER_REVISION = require("./base").COMPILER_REVISION;
var REVISION_CHANGES = require("./base").REVISION_CHANGES;
var createFrame = require("./base").createFrame;

function checkRevision(compilerInfo) {
  var compilerRevision = compilerInfo && compilerInfo[0] || 1,
      currentRevision = COMPILER_REVISION;

  if (compilerRevision !== currentRevision) {
    if (compilerRevision < currentRevision) {
      var runtimeVersions = REVISION_CHANGES[currentRevision],
          compilerVersions = REVISION_CHANGES[compilerRevision];
      throw new Exception("Template was precompiled with an older version of Handlebars than the current runtime. "+
            "Please update your precompiler to a newer version ("+runtimeVersions+") or downgrade your runtime to an older version ("+compilerVersions+").");
    } else {
      // Use the embedded version info since the runtime doesn't know about this revision yet
      throw new Exception("Template was precompiled with a newer version of Handlebars than the current runtime. "+
            "Please update your runtime to a newer version ("+compilerInfo[1]+").");
    }
  }
}

exports.checkRevision = checkRevision;// TODO: Remove this line and break up compilePartial

function template(templateSpec, env) {
  /* istanbul ignore next */
  if (!env) {
    throw new Exception("No environment passed to template");
  }
  if (!templateSpec || !templateSpec.main) {
    throw new Exception('Unknown template object: ' + typeof templateSpec);
  }

  // Note: Using env.VM references rather than local var references throughout this section to allow
  // for external users to override these as psuedo-supported APIs.
  env.VM.checkRevision(templateSpec.compiler);

  var invokePartialWrapper = function(partial, indent, name, context, hash, helpers, partials, data, depths) {
    if (hash) {
      context = Utils.extend({}, context, hash);
    }

    var result = env.VM.invokePartial.call(this, partial, name, context, helpers, partials, data, depths);

    if (result == null && env.compile) {
      var options = { helpers: helpers, partials: partials, data: data, depths: depths };
      partials[name] = env.compile(partial, { data: data !== undefined, compat: templateSpec.compat }, env);
      result = partials[name](context, options);
    }
    if (result != null) {
      if (indent) {
        var lines = result.split('\n');
        for (var i = 0, l = lines.length; i < l; i++) {
          if (!lines[i] && i + 1 === l) {
            break;
          }

          lines[i] = indent + lines[i];
        }
        result = lines.join('\n');
      }
      return result;
    } else {
      throw new Exception("The partial " + name + " could not be compiled when running in runtime-only mode");
    }
  };

  // Just add water
  var container = {
    lookup: function(depths, name) {
      var len = depths.length;
      for (var i = 0; i < len; i++) {
        if (depths[i] && depths[i][name] != null) {
          return depths[i][name];
        }
      }
    },
    lambda: function(current, context) {
      return typeof current === 'function' ? current.call(context) : current;
    },

    escapeExpression: Utils.escapeExpression,
    invokePartial: invokePartialWrapper,

    fn: function(i) {
      return templateSpec[i];
    },

    programs: [],
    program: function(i, data, depths) {
      var programWrapper = this.programs[i],
          fn = this.fn(i);
      if (data || depths) {
        programWrapper = program(this, i, fn, data, depths);
      } else if (!programWrapper) {
        programWrapper = this.programs[i] = program(this, i, fn);
      }
      return programWrapper;
    },

    data: function(data, depth) {
      while (data && depth--) {
        data = data._parent;
      }
      return data;
    },
    merge: function(param, common) {
      var ret = param || common;

      if (param && common && (param !== common)) {
        ret = Utils.extend({}, common, param);
      }

      return ret;
    },

    noop: env.VM.noop,
    compilerInfo: templateSpec.compiler
  };

  var ret = function(context, options) {
    options = options || {};
    var data = options.data;

    ret._setup(options);
    if (!options.partial && templateSpec.useData) {
      data = initData(context, data);
    }
    var depths;
    if (templateSpec.useDepths) {
      depths = options.depths ? [context].concat(options.depths) : [context];
    }

    return templateSpec.main.call(container, context, container.helpers, container.partials, data, depths);
  };
  ret.isTop = true;

  ret._setup = function(options) {
    if (!options.partial) {
      container.helpers = container.merge(options.helpers, env.helpers);

      if (templateSpec.usePartial) {
        container.partials = container.merge(options.partials, env.partials);
      }
    } else {
      container.helpers = options.helpers;
      container.partials = options.partials;
    }
  };

  ret._child = function(i, data, depths) {
    if (templateSpec.useDepths && !depths) {
      throw new Exception('must pass parent depths');
    }

    return program(container, i, templateSpec[i], data, depths);
  };
  return ret;
}

exports.template = template;function program(container, i, fn, data, depths) {
  var prog = function(context, options) {
    options = options || {};

    return fn.call(container, context, container.helpers, container.partials, options.data || data, depths && [context].concat(depths));
  };
  prog.program = i;
  prog.depth = depths ? depths.length : 0;
  return prog;
}

exports.program = program;function invokePartial(partial, name, context, helpers, partials, data, depths) {
  var options = { partial: true, helpers: helpers, partials: partials, data: data, depths: depths };

  if(partial === undefined) {
    throw new Exception("The partial " + name + " could not be found");
  } else if(partial instanceof Function) {
    return partial(context, options);
  }
}

exports.invokePartial = invokePartial;function noop() { return ""; }

exports.noop = noop;function initData(context, data) {
  if (!data || !('root' in data)) {
    data = data ? createFrame(data) : {};
    data.root = context;
  }
  return data;
}
},{"./base":17,"./exception":18,"./utils":21}],20:[function(require,module,exports){
"use strict";
// Build out our basic SafeString type
function SafeString(string) {
  this.string = string;
}

SafeString.prototype.toString = function() {
  return "" + this.string;
};

exports["default"] = SafeString;
},{}],21:[function(require,module,exports){
"use strict";
/*jshint -W004 */
var SafeString = require("./safe-string")["default"];

var escape = {
  "&": "&amp;",
  "<": "&lt;",
  ">": "&gt;",
  '"': "&quot;",
  "'": "&#x27;",
  "`": "&#x60;"
};

var badChars = /[&<>"'`]/g;
var possible = /[&<>"'`]/;

function escapeChar(chr) {
  return escape[chr];
}

function extend(obj /* , ...source */) {
  for (var i = 1; i < arguments.length; i++) {
    for (var key in arguments[i]) {
      if (Object.prototype.hasOwnProperty.call(arguments[i], key)) {
        obj[key] = arguments[i][key];
      }
    }
  }

  return obj;
}

exports.extend = extend;var toString = Object.prototype.toString;
exports.toString = toString;
// Sourced from lodash
// https://github.com/bestiejs/lodash/blob/master/LICENSE.txt
var isFunction = function(value) {
  return typeof value === 'function';
};
// fallback for older versions of Chrome and Safari
/* istanbul ignore next */
if (isFunction(/x/)) {
  isFunction = function(value) {
    return typeof value === 'function' && toString.call(value) === '[object Function]';
  };
}
var isFunction;
exports.isFunction = isFunction;
/* istanbul ignore next */
var isArray = Array.isArray || function(value) {
  return (value && typeof value === 'object') ? toString.call(value) === '[object Array]' : false;
};
exports.isArray = isArray;

function escapeExpression(string) {
  // don't escape SafeStrings, since they're already safe
  if (string instanceof SafeString) {
    return string.toString();
  } else if (string == null) {
    return "";
  } else if (!string) {
    return string + '';
  }

  // Force a string conversion as this will be done by the append regardless and
  // the regex test will do this transparently behind the scenes, causing issues if
  // an object's to string has escaped characters in it.
  string = "" + string;

  if(!possible.test(string)) { return string; }
  return string.replace(badChars, escapeChar);
}

exports.escapeExpression = escapeExpression;function isEmpty(value) {
  if (!value && value !== 0) {
    return true;
  } else if (isArray(value) && value.length === 0) {
    return true;
  } else {
    return false;
  }
}

exports.isEmpty = isEmpty;function appendContextPath(contextPath, id) {
  return (contextPath ? contextPath + '.' : '') + id;
}

exports.appendContextPath = appendContextPath;
},{"./safe-string":20}],22:[function(require,module,exports){
// Create a simple path alias to allow browserify to resolve
// the runtime on a supported path.
module.exports = require('./dist/cjs/handlebars.runtime');

},{"./dist/cjs/handlebars.runtime":16}],23:[function(require,module,exports){
module.exports = require("handlebars/runtime")["default"];

},{"handlebars/runtime":22}]},{},[1])


//# sourceMappingURL=app.js.map