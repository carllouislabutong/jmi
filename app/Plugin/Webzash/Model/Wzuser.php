<?php

App::uses('WebzashAppModel', 'Webzash.Model');

/**
* Webzash Plugin Wzuser Model
*
* @package Webzash
* @subpackage Webzash.model
*/
class Wzuser extends WebzashAppModel {

	public $validationDomain = 'webzash';

	/* Validation rules for the Wzuser table */
	public $validate = array(
		'username' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Username cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isUnique',
				'message' => 'Username is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Username cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'fullname' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Fullname cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Fullname cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'password' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Password cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'email' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Email cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'email',
				'message' => 'Email is not a valid email address',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => 'isUnique',
				'message' => 'Email is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'timezone' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Timezone cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'role' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Role cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('inList', array('admin', 'manager', 'accountant', 'dataentry', 'guest')),
				'message' => 'Invalid value for role',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'status' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Status cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for status',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'email_verified' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Email verified cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for email verified',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'admin_verified' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Administrator approved cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for administrator approved',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'retry_count' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'message' => 'Retry count is not a valid number',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('naturalNumber', true),
				'message' => 'Retry count cannot contain a decimal point',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'all_accounts' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'All accounts access cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for all accounts access',
				'required' => true,
				'allowEmpty' => false,
			),
		),
	);
}
