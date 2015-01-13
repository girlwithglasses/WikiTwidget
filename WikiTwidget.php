<?php
/*

introductory material...

*/

if ( ! defined( 'MEDIAWIKI' ) ) die();

# Credits
$wgExtensionCredits['parserhook']['WikiTwidget'] = array(
    'name'=>'WikiTwidget',
    'author'=>'Amelia Ireland',
    'descriptionmsg'=>'wikitwidget-desc',
    'version'=>'0.3.1',
    'url' => 'http://www.mediawiki.org/wiki/Extension:WikiTwidget',
);

$wgAutoloadClasses['WikiTwidget'] =  __DIR__ . "/WikiTwidget.body.php";
$wgMessagesDirs['WikiTwidget'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['WikiTwidget'] = __DIR__ . '/WikiTwidget.i18n.php';

$wgResourceModules['WikiTwidget'] = array(
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'WikiTwidget',
	'scripts' => 'ext.wikitwidget.js'
);

$wgHooks['ParserFirstCallInit'][] = 'wfWikiTwidgetSetup';

function wfWikiTwidgetSetup( Parser $parser ) {
	$mm = new WikiTwidget;
	$parser->setHook( 'wikitwidget', array($mm, 'createWidget') );
	return true;
}
