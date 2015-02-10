<?php

class WikiTwidget {

	function createWidget($input, array $args, Parser $parser, PPFrame $frame ) {
#		Widget URL format
#		<a class="twitter-timeline" href="https://twitter.com/twitterapi" data-widget-id="YOUR-WIDGET-ID-HERE" data-theme="dark" data-link-color="#cc0000"  data-related="twitterapi,twitter" data-aria-polite="assertive" width="300" height="500" lang="EN">Tweets by @twitterapi</a>

		if (isset($args['data-widget-id']) && $args['data-widget-id']) {
			$id = $args['data-widget-id'];
		}
		else {
			## Error!!
			return Html::element( 'div',
				array( 'class' => 'error' ),
				wfMessage( 'wikitwidget-no-id-err' )->inContentLanguage()->text() );
		}

		## check that the ID looks OK
		if (preg_match('/\D/', $id)){
			return Html::element( 'div',
				array( 'class' => 'error' ),
				wfMessage( 'wikitwidget-id-err', $id )->inContentLanguage()->text() );
		}

		$attribs = array();
		$attribs['class'] = "twitter-timeline";
		$attribs['data-widget-id'] = $id;

## Lists:
## <a class="twitter-timeline" href="https://twitter.com/USERNAME/LIST-NAME" data-widget-id="268946990140887041">Tweets from @USERNAME/LIST-NAME</a>

## Favourites:
## <a class="twitter-timeline" href="https://twitter.com/USERNAME/favorites" data-widget-id="268945361438121984">Favorite Tweets by @USERNAME</a>

## Searches:
## <a class="twitter-timeline" href="https://twitter.com/search?q=STRING" data-widget-id="268946405488476160">Tweets about "STRING"</a>

		## make sure we have a link
		if (isset($args['href']) && $args['href']) {
			## make up a string for the link

			## get rid of the 'twitter' part of the URL
			if (preg_match( '@https://twitter.com/search\?q=(.+)@', $args['href'], $matches )) {
				## search is for $matches[1]
				$text = wfMessage( 'wikitwidget-alt-search', $matches[1] )->inContentLanguage()->text();
				$attribs['href'] = $args['href'];
			}
			else if (preg_match( '@https://twitter.com/(.+?)/favorites@', $args['href'], $matches )) {
				## favourite tweets of $matches[1]
				$text = wfMessage( 'wikitwidget-alt-favorites', $matches[1] )->inContentLanguage()->text();
				$attribs['href'] = $args['href'];
			}
			else if (preg_match( '@https://twitter.com/(.+)@', $args['href'], $matches )) {
				## tweets by $matches[1]
				$text = wfMessage( 'wikitwidget-alt-feed', $matches[1] )->inContentLanguage()->text();
				$attribs['href'] = $args['href'];
			}
			else {
				## wtf is going on with this href?!
				$text = wfMessage( 'wikitwidget-alt-fallback' )->inContentLanguage()->text();
				$attribs['href'] = 'https://twitter.com/';
			}
		}
		else {
			## it will just have to be blank!
			$text = wfMessage( 'wikitwidget-alt-fallback' )->inContentLanguage()->text();
			$attribs['href'] = 'https://twitter.com/';
		}

# `data-theme` (the theme of the widget): light or dark
# `data-link-color` (link colour): specify as a hex code, e.g. #00ff99
# `data-border-color` (border colour): hex code
# `data-chrome` (widget appearance): add as many of the following as desired, separated by a space:
## `noheader` - removes the header
## `nofooter` -  removes footer and Tweet box
## `noborders` - hides all borders in and around the widget
## `noscrollbar` - hides main timeline scrollbar
## `transparent` - no background colour
# `width` (widget width in pixels)
# `height` (widget height in pixels)
# `lang` (language)
# `data-tweet-limit` (the number of tweets displayed in a timeline; widget will not update with this option on): between 1 and 20
# `data-related` (suggest other tweeps to follow)
# `data-aria-polite` (settings for users with assistive technology): polite or assertive
		$vars = array('data-theme', 'data-link-color', 'data-border-color', 'data-chrome', 'data-tweet-limit', 'data-related', 'data-aria-polite', 'width', 'height', 'lang');

		foreach ($vars as $v) {
			if (isset($args[$v]) && $args[$v]) {
				## add to our html tag
				$attribs[$v] = $args[$v];
			}
		}

		$parser->getOutput()->addModules( 'ext.WikiTwidget' );
		return Html::element( 'a',
			$attribs,
			$text );
	}
}
