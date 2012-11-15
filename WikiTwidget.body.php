<?php

class WikiTwidget {

	function createWidget($input, array $args, Parser $parser, PPFrame $frame ) {

		$return_txt = '<a class="twitter-timeline" href="https://twitter.com/gmodproject" data-widget-id="268391087838728192"';

## The minimum width of a timeline is 220px and the maximum is 520px.
## The minimum height is 350px.

		if( isset( $args['width'] ) && $args['width'] ) {
			$w = $args['width'];
			## width should only contain numbers
			if (preg_match('/\D/', $w))
			{	return "<div class='error'>" . wfMessage( 'wikitwidget-h-w-err', htmlspecialchars($w)) . "</div>";
			}
			$width = (int)$w;
			if ($width > 220 && $width < 520)
			{	$return_txt = $return_txt . ' width="' . $width . '"';
			}
		}

		if( isset( $args['height'] ) && $args['height'] ) {
			$h = $args['height'];
			## height should only contain numbers
			if (preg_match('/\D/', $h))
			{	return "<div class='error'>" . wfMessage( 'wikitwidget-h-w-err', htmlspecialchars($h)) . "</div>";
			}
			$height = (int)$h;
			if ($height > 350)
			{	$return_txt = $return_txt . ' height="' . $height . '"';
			}
		}
		$return_txt = $return_txt . '>Tweets by @gmodproject</a>';

		return $return_txt;
	}
}
