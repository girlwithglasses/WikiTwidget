<?php

class WikiTwidget {

	function createWidget($input, array $args, Parser $parser, PPFrame $frame ) {	global $wgOut;
		global $wgWikiTwidgetAccs;

		$name = 'blank';
		$id = '';

#		Widget URL format
#		<a class="twitter-timeline" href="https://twitter.com/twitterapi" data-widget-id="YOUR-WIDGET-ID-HERE" data-theme="dark" data-link-color="#cc0000"  data-related="twitterapi,twitter" data-aria-polite="assertive" width="300" height="500" lang="EN">Tweets by @twitterapi</a>

		if (isset($args['data-widget-id']) && $args['data-widget-id']){
			$id = $args['data-widget-id'];
		}
		else if(isset($wgWikiTwidgetAccs['id']) && $wgWikiTwidgetAccs['id']){
			$id = $wgWikiTwidgetAccs['id'];
		}
		else {
			## Error!!
			return "<div class='error'>" . wfMessage( 'wikitwidget-no-id-err' ) . "</div>";
		}
		
		## check that the ID looks OK
		if (preg_match('/\D/', $id)){
			return "<div class='error'>" . wfMessage( 'wikitwidget-id-err', htmlspecialchars($id)) . "</div>";
		}

		## get the name of the twitterer
		if (isset($args['href']) && $args['href']){
			$name = $args['href'];
			$rp = strripos($args['href'],'/');
			if ($rp)
			{	$name = substr($args['href'], $rp);
			}
		}
		else if(isset($wgWikiTwidgetAccs['name']) && $wgWikiTwidgetAccs['name']){
			$name = $wgWikiTwidgetAccs['name'];
		}
		else {
			## it will just have to be blank!
		}

		$txt = '<a class="twitter-timeline" data-widget-id="' . $id . '" href="https://twitter.com/' . $name . '"';

		$vars = array('data-theme', 'data-link-color', 'data-related', 'data-aria-polite', 'width', 'height', 'lang');

		foreach ($vars as $v)
		{	if (isset($args[$v]) && $args[$v])
			{	## add to our html tag
				$txt .= ' ' . $v . '="' . $args[$v] . '"';
			}
		}

		$txt = $txt . '>Tweets by @' . $name . '</a>';
		$wgOut->addModules( 'WikiTwidget' );
		return $txt;
	}
}
