<?php


App::uses('WebzashAppModel', 'Webzash.Model');

/**
* Webzash Plugin Wzuseraccount Model
*
* @package Webzash
* @subpackage Webzash.model
*/
class Wzuseraccount extends WebzashAppModel {

	public $validationDomain = 'webzash';

	/* Validation rules for the Wzuseraccount table */
	public $validate = array(
		'wzuser_id' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'User id cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 11),
				'message' => 'User id cannot be more than 11 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'wzaccount_id' => array(
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'Account id cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 11),
				'message' => 'Account id cannot be more than 11 characters',
				'required' => true,
				'allowEmpty' => false,
			),
		),
	);
}
