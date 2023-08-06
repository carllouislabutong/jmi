<?php


App::uses('WebzashAppModel', 'Webzash.Model');

/**
* Webzash Plugin EntryType Model
*
* @package Webzash
* @subpackage Webzash.model
*/
class Entrytype extends WebzashAppModel {

	public $validationDomain = 'webzash';

	/* Validation rules for the Entrytypes table */
	public $validate = array(
		'label' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Label cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isUnique',
				'message' => 'Label is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Label cannot be more than 100 characters',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Label can contain only letter and digits',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'name' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Name cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isUnique',
				'message' => 'Name is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Name cannot be more than 100 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'description' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Description cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'base_type' => array(
			'rule1' => array(
				'rule' => array('inList', array('1')),
				'message' => 'Invalid option for base type',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'numbering' => array(
			'rule1' => array(
				'rule' => array('inList', array('1', '2', '3')),
				'message' => 'Invalid option for numbering',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'prefix' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Prefix cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'suffix' => array(
			'rule1' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Suffix cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'zero_padding' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'message' => 'Zero padding is not valid number',
				'required' => true,
				'allowEmpty' => true,
			),
			'rule2' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Zero padding should be more than 0',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('comparison', '<=', 99),
				'message' => 'Zero padding should be less than 99',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => array('naturalNumber', true),
				'message' => 'Zero padding cannot contain a decimal point',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'restriction_bankcash' => array(
			'rule1' => array(
				'rule' => array('inList', array('1', '2', '3', '4', '5')),
				'message' => 'Invalid option for restrictions',
				'required' => true,
				'allowEmpty' => false,
			),
		),

	);

}
