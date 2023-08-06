<?php


App::uses('WebzashAppController', 'Webzash.Controller');

/**
 * Webzash Plugin Help Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class HelpController extends WebzashAppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->set('title_for_layout', __d('webzash', 'Help'));

		return;
	}

	/* Authorization check */
	public function isAuthorized($user) {

		if ($this->action === 'index') {
			return $this->Permission->is_registered_allowed();
		}

		return parent::isAuthorized($user);
	}
}
