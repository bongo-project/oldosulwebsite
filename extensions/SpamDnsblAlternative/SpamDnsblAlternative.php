<?php
/**
 * SpamDnsblAlternative extension
 *
 * @file
 * @ingroup Extensions
 *
 * This file contains the main include file for the SpamDnsblAlternative extension of
 * MediaWiki.
 *
 * Usage: Add the following line in LocalSettings.php:
 * require_once( "$IP/extensions/SpamDnsblAlternative/SpamDnsblAlternative.php" );
 *
 * @author Simon Litt <slsoft@bk.ru>
 * @copyright Copyright © 2011, Simon Litt
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @version 1.0.0
 */
 
 if(!defined('MEDIAWIKI')) {
	echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die(1);
}

// Credits
$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'version'        => '1.0.0',
	'name'           => 'Spam DNS Blacklist Alternative ',
	'author'         => array( 'Simon Litt' ),
	'url'            => 'http://www.mediawiki.org/wiki/Extension:SpamDnsblAlternative',
	'description'    => 'Provides DNS-based Blacklist techniques to protect against spam.',
);

$wgHooks['EditPage::attemptSave'][] = 'efDnsblAlternativeEdit';
$wgHooks['AbortNewAccount'][] = 'efDnsblAlternativeUserCreate';

function efDnsblAlternativeIsDisabled( $ip, $user ) {
	global $wgEnableDnsBlacklist, $wgDnsBlacklistUrls, $wgProxyWhitelist;

	if ( $wgEnableDnsBlacklist || in_array( $ip, $wgProxyWhitelist ) )
		return false;

	wfDebug( __METHOD__.": checking user ip...\n" );
	if ($user->inDnsBlacklist( $ip, $wgDnsBlacklistUrls )) {
		return true;
	}

	return false;
}

function efDnsblAlternativeEdit( $editpage ) {
	global $wgUser;

	if ($wgUser->isAllowed( 'ipblock-exempt' ) || $wgUser->isAllowed( 'proxyunbannable' ))
		return true;

	$ip = wfGetIP();

	if ( efDnsblAlternativeIsDisabled($ip, $wgUser) ) {
		$editpage->spamPageWithContent();
		return false;
	}
	return true;
}

function efDnsblAlternativeUserCreate( $user, $message ) {

	$ip = wfGetIP();

	if ( efDnsblAlternativeIsDisabled($ip, $user) ) {
		$message = wfMsg( 'sorbs_create_account_reason' ) . ' (' . htmlspecialchars( $ip ) . ')';
		return false;
	}
	return true;
}
