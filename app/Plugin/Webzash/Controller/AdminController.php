<?php


App::uses('WebzashAppController', 'Webzash.Controller');

/**
 * Webzash Plugin Admin Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class AdminController extends WebzashAppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Webzash.Wzsetting');

	var $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->set('title_for_layout', __d('webzash', 'Administrator Dashboard'));

		$this->Wzsetting->useDbConfig = 'wz';

		$wzsetting = $this->Wzsetting->findById(1);
		if (!$wzsetting) {
			$this->Session->setFlash(__d('webzash', 'Please update your setting first.'), 'danger');
			return $this->redirect(array('plugin' => 'webzash', 'controller' => 'wzsettings', 'action' => 'edit'));
		}

		return;
	}

	/* Authorization check */
	public function isAuthorized($user) {
		if ($this->action === 'index') {
			return $this->Permission->is_admin_allowed();
		}

		return parent::isAuthorized($user);
	}
}
