<?php


App::uses('WebzashAppModel', 'Webzash.Model');

/**
* Webzash Plugin Group Model
*
* @package Webzash
* @subpackage Webzash.model
*/
class Group extends WebzashAppModel {

	public $validationDomain = 'webzash';

	/* Validation rules for the Group table */
	public $validate = array(
		'parent_id' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Parent group cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'numeric',
				'message' => 'Parent group is not a valid number',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => 'parentValid',
				'message' => 'Parent group is not valid',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => array('maxLength', 18),
				'message' => 'Parent group id length cannot be more than 18',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'name' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Group name cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isUnique',
				'message' => 'Group name is already in use',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Group name cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'code' => array(
			'rule1' => array(
				'rule' => 'isUnique',
				'message' => 'Group code is already in use',
				'required' => true,
				'allowEmpty' => true,
			),
			'rule2' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Group code cannot be more than 255 characters',
				'required' => true,
				'allowEmpty' => true,
			),
			'rule3' => array(
				'rule' => 'isUniqueInLedger',
				'message' => 'Group code is already in use by a ledger account',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'affects_gross' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Affects Gross or Net Profit & Loss cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'boolean',
				'message' => 'Invalid value for whether the account group affects Gross or Net Profit & Loss',
				'required' => true,
				'allowEmpty' => false,
			),
		),
	);

	/* Validation - Check if parent_id is a valid id */
	public function parentValid($data) {
		if (empty($data['parent_id'])) {
			return false;
		}

		$parentCount = $this->find('count', array(
		    'conditions' => array('id' => $data['parent_id']),
		));

		if ($parentCount < 1) {
			return false;
		} else {
			return true;
		}
	}

	/* Validation - Check if code is unique across groups and ledgers */
	public function isUniqueInLedger($data) {
		if (empty($data['code'])) {
			return true;
		}

		/* Load the Ledger model */
		App::import("Webzash.Model", "Ledger");
		$Ledger = new Ledger();

		$count = $Ledger->find('count', array(
		    'conditions' => array('code' => $data['code']),
		));

		if ($count != 0) {
			return false;
		} else {
			return true;
		}
	}
}
