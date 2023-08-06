<?php

$config['map'] = array(
	'User' => 'User/username',
	'Role' => 'User/group_id',
);

/**
 * define aliases to map your model information to
 * the roles defined in your role configuration.
 */
$config['alias'] = array(
	'Role/4' => 'Role/editor',
);

/**
 * role configuration
 */
$config['roles'] = array(
	'Role/admin' => null,
);

/**
 * rule configuration
 */
$config['rules'] = array(
	'allow' => array(
		'*' => 'Role/admin',
	),
	'deny' => array(),
);
