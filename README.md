WikiTwidget

Your one-stop-shop for embedding a Twitter widget into your wiki. Unless you choose a different way to do it.


Installation
============

Download and extract the files in a directory called "WikiTwidget" in your extensions/ folder.

Add the following code to your LocalSettings.php (at the bottom)

  require_once( "$IP/extensions/WikiTwidget/WikiTwidget.php" );

Navigate to Special:Version on your wiki to verify that the extension is successfully installed.


Configuration parameters
========================

To use WikiTwidget, you need to create a Twitter widget first (https://twitter.com/settings/widgets). Twitter will generate some code that looks like this:

  <a class="twitter-timeline" href="https://twitter.com/mycooltwittername"
data-widget-id="123345678901234567890">Tweets by @mycooltwittername</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

To insert this widget into the page, copy the "a" tag but do not include the text "Tweets by..." or the close tag. You should have some code like this:

  <a class="twitter-timeline" href="https://twitter.com/mycooltwittername" data-widget-id="123345678901234567890">

Remove the "a" at the start of the tag and replace it with "wikitwidget", and add a slash before the final ">".

  <wikitwidget class="twitter-timeline" href="https://twitter.com/mycooltwittername" data-widget-id="123345678901234567890" />

Insert this tag into the page, and voilà! You can enjoy your embedded Twitter feed on your wiki.

Further customization options can be specified when creating the widget; see the developer documentation on Twitter timelines (https://dev.twitter.com/docs/embedded-timelines) for more information. Valid widget attributes added to the wikitwidget tag will be transferred to the finished widget. Valid tags are:

*data-theme (the theme of the widget): light or dark
*data-link-color (link colour)
*width (widget width in pixels)
*height (widget height in pixels)
*lang (language)
*data-related (suggest other tweeps to follow)
*data-aria-polite (settings for users with assistive technology): polite or assertive


Troubleshooting
===============

WikiTwidget is an extremely simple extension; all it does is convert a "wikitwidget" tag into an "a" tag, and add some javascript to the page. WikiTwidget does some minimal checking of parameters, and will throw up an error if something looks obviously wrong, e.g. if the data-widget-id value is not numerical. The Twitter widget itself created using javascript, so the symptoms of something being amiss will generally be that in place of a widget, you'll see a link saying "Tweets from username" (or "Tweets about ...", "Favourite tweets by ..."). Check that the data-widget-id value is correct, that javascript is enabled in your browser, and that you don't have a browser plugin like Ghostery blocking scripts from another domain. Also ensure that your domain is enabled on your widget (part of the configuration of the Twitter widget).


Wiki Compatibility
==================

WikiTwidget uses ResourceLoader, which was introduced in MW 1.17. I only have access to a wiki running 1.19.2, so I cannot guarantee that WikiTwidget will work on earlier versions of MediaWiki. A quick solution for earlier MediaWikis is to add the javascript to MediaWiki:Common.js on your wiki:

function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");


Change Log
==========

v0.2:
*Removed support for settings in LocalSettings.php
*Added code to generate an appropriate link tag for favourites, lists, and searches.


To Do
=====

*change percent-encoded characters into the actual characters
*allow pasting of whole link from Twitter inside the wikitwidget tag?


Please email comments, questions, or bug reports to amelia.ireland at gmod.org.
