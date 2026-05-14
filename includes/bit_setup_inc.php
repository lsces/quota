<?php
global $gBitSystem, $gBitSmarty;

$pRegisterHash = [
	'package_name' => 'quota',
	'package_path' => dirname( dirname( __FILE__ ) ) . '/',
	'homeable'     => true,
];

// fix to quieten down VS Code which can't see the dynamic creation of these ...
define( 'QUOTA_PKG_NAME', $pRegisterHash['package_name'] );
define( 'QUOTA_PKG_URL', BIT_ROOT_URL . basename( $pRegisterHash['package_path'] ) . '/' );
define( 'QUOTA_PKG_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/' );
define( 'QUOTA_PKG_INCLUDE_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/includes/');
define( 'QUOTA_PKG_CLASS_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/includes/classes/');
define( 'QUOTA_PKG_ADMIN_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/admin/');

$gBitSystem->registerPackage( $pRegisterHash );
