<?php

App::uses('WebzashAppModel', 'Webzash.Model');

/**
* Webzash Plugin Wzaccount Model
*
* @package Webzash
* @subpackage Webzash.model
*/
class Wzaccount extends WebzashAppModel {

	public $validationDomain = 'webzash';

	/* Validation rules for the Wzaccount table */
	public $validate = array(
		'label' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Account label cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isUnique',
				'message' => 'Account label is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Account label cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Account label can only be alpha-numeric',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_datasource' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Database type cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('inList', array('Database/Mysql', 'Database/Sqlserver', 'Database/Postgres')),
				'message' => 'Invalid value for database type',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_database' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Database name cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database name cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_host' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Database host cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database host cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_port' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'message' => 'Port is not a valid number',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Port should be more than 0',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('comparison', '<=', 65000),
				'message' => 'Port should be less than 65000',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => 'naturalNumber',
				'message' => 'Port cannot contain a decimal point',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_login' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database login cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_password' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database password cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'db_prefix' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database name cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'db_persistent' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Database persistent connection cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for database persistent connection',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'db_schema' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database schema cannot be more than 255 characters',
				'required' => false,
				'allowEmpty' => true,
			),
		),
		'db_unixsocket' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database unixsocket cannot be more than 255 characters',
				'required' => false,
				'allowEmpty' => true,
			),
		),
		'db_settings' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Database settings cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
	);
}
