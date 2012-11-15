<?php
/*

introductory material...

*/

if ( ! defined( 'MEDIAWIKI' ) ) die();

# Credits
$wgExtensionCredits['parserhook']['WikiTwidget'] = array(
    'name'=>'WikiTwidget',
    'author'=>'Amelia Ireland',
    'description'=>'wikitwidget-desc',
    'version'=>'0.1'
);

$wgAutoloadClasses['WikiTwidget'] =  dirname( __FILE__ ) . "/WikiTwidget.body.php";
$wgExtensionMessagesFiles['WikiTwidget'] = dirname( __FILE__ ) . '/WikiTwidget.i18n.php';

$wgResourceModules['WikiTwidget'] = array(
'scripts' => 'ext.wikitwidget.js',
'localBasePath' => dirname( __FILE__ ),
'remoteExtPath' => 'WikiTwidget'
);

$wgHooks['ParserFirstCallInit'][] = 'wfWikiTwidgetSetup';

function wfWikiTwidgetSetup( Parser $parser ) {
	$mm = new WikiTwidget;
	$parser->setHook( 'wikitwidget', array($mm, 'createWidget') );
	return true;
}

