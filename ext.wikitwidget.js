/*
	Twitter embed code from https://dev.twitter.com/web/embedded-timelines
	updated 12 Jan 2015
*/
( function ( mw, $ ) {
	window.twttr = (function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0], t = window.twttr || {};
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src= "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
		t._e = []; t.ready = function (f) { t._e.push(f); };
		return t;
	}(document, "script", "twitter-wjs"));
} )( mediaWiki, jQuery );
