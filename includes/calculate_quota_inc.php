<?php
/**
 * @version  $Revision$
 * @package  quota
 * 
 * settings that are useful to know about at upload time
 */

/**
 * quota setup
 */

use Bitweaver\KernelTools;
use Bitweaver\Quota\LibertyQuota;

$quota = new LibertyQuota();
if( !$gBitUser->isAdmin() && !$quota->isUserUnderQuota( $gBitUser->mUserId ) ) {
	$gBitSystem->display( 'bitpackage:quota/over_quota.tpl', KernelTools::tra( 'You are over your quota.' ) , [ 'display_mode' => 'display' ]);
	die;
}

if( !$gBitUser->isAdmin() ) {
	// Prevent people from uploading more than their quota
	$q = $quota->getUserQuota( $gBitUser->mUserId );
	$u = $quota->getUserUsage( $gBitUser->mUserId );
	$gBitSmarty->assign( 'quotaMessage', KernelTools::tra( 'Your remaining disk quota is' ).' '.round( ( $q - $u ) / 1000000, 2 ).' '.KernelTools::tra( 'Megabytes' ) );
	$qMegs = round( $q / 1000000 );
	if( $qMegs < $uploadMax ) {
		$uploadMax = $qMegs;
	}
}
