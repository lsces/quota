<?php

$tables = [

	'users_quota_units' => "
	user_id I4 PRIMARY,
	units I4 NOTNULL
",

	'quotas'            => "
	quota_id I4 PRIMARY,
	disk_usage I8,
	monthly_transfer I8,
	title C(160) NOTNULL,
	description X
",

	'quotas_group_map'  => "
	quota_id I4 PRIMARY,
	group_id I4 PRIMARY
	CONSTRAINT ', CONSTRAINT `quotas_group_ref` FOREIGN KEY (`group_id`) REFERENCES `" . BIT_DB_PREFIX . "users_groups`( `group_id` )
				, CONSTRAINT `quotas_map_ref` FOREIGN KEY (`quota_id`) REFERENCES `" . BIT_DB_PREFIX . "quotas`( `quota_id` )'
",

];

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( QUOTA_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( QUOTA_PKG_NAME, [
	'description' => "Quota system limits user disk and bandwidth usage for Liberty content",
	'license'     => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
] );

// ### Indexes
$indices = [
	'quotas_group_idx' => [ 'table' => 'quotas_group_map', 'cols' => 'group_id', 'opts' => [ 'UNIQUE' ] ],
];
$gBitInstaller->registerSchemaIndexes( QUOTA_PKG_NAME, $indices );

// ### Sequences
$sequences = [
	'quota_id_seq' => [ 'start' => 3 ],
];
$gBitInstaller->registerSchemaSequences( QUOTA_PKG_NAME, $sequences );

$gBitInstaller->registerUserPermissions( QUOTA_PKG_NAME, [
	[ 'p_quota_create', 'Can create a quota', 'registered', QUOTA_PKG_NAME ],
	[ 'p_quota_edit', 'Can edit any quota', 'editors', QUOTA_PKG_NAME ],
	[ 'p_quota_admin', 'Can admin quota', 'editors', QUOTA_PKG_NAME ],
	[ 'p_quota_read', 'Can read quota', 'basic', QUOTA_PKG_NAME ],
	[ 'p_quota_unlimited', 'Can upload unlimited amount of data', 'editors', QUOTA_PKG_NAME ],
] );

$gBitInstaller->registerPreferences( QUOTA_PKG_NAME, [
	[ QUOTA_PKG_NAME, 'quota_default_ordering', 'title_desc' ],
	[ QUOTA_PKG_NAME, 'quota_list_content_id', 'y' ],
	[ QUOTA_PKG_NAME, 'quota_list_title', 'y' ],
	[ QUOTA_PKG_NAME, 'quota_list_description', 'y' ],
] );

//$gBitInstaller->registerSchemaDefault( QUOTA_PKG_NAME, [
//] );
