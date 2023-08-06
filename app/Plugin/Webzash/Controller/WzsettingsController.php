<?php


App::uses('WebzashAppController', 'Webzash.Controller');
App::uses('ConnectionManager', 'Model');

/**
 * Webzash Plugin Wzsettings Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class WzsettingsController extends WebzashAppController {

	var $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('plugin' => 'webzash', 'controller' => 'wzsettings', 'action' => 'edit'));
	}

/**
 * edit method
 *
 * @return void
 */
	public function edit() {

		$this->set('title_for_layout', __d('webzash', 'Edit General Settings'));

		$this->Wzsetting->useDbConfig = 'wz';

		$wzsetting = $this->Wzsetting->findById(1);

		/* on POST */
		if ($this->request->is('post') || $this->request->is('put')) {
			/* Set settings id */
			unset($this->request->data['Wzsetting']['id']);

			/* Save settings */
			$ds = $this->Wzsetting->getDataSource();
			$ds->begin();

			if (!$wzsetting) {
				$this->Wzsetting->create();
				$this->request->data['Wzsetting']['id'] = 1;
			} else {
				$this->Wzsetting->id = 1;
			}

			if (empty($this->request->data['Wzsetting']['email_port'])) {
				$this->request->data['Wzsetting']['email_port'] = 0;
			}

			if ($this->Wzsetting->save($this->request->data)) {
				$ds->commit();
				$this->Session->setFlash(__d('webzash', 'Settings updated. Please relogin for the new settings to take effect.'), 'success');
				return $this->redirect(array('plugin' => 'webzash', 'controller' => 'admin', 'action' => 'index'));
			} else {
				$ds->rollback();
				$this->Session->setFlash(__d('webzash', 'Failed to update settings. Please, try again.'), 'danger');
				return;
			}
		} else {
			$this->request->data = $wzsetting;
			return;
		}
	}

/**
 * System information method
 *
 * @return void
 */
	public function sysinfo() {

		$this->set('actionlinks', array(
			array('controller' => 'admin', 'action' => 'index', 'title' => __d('webzash', 'Back')),
		));

		$this->set('title_for_layout', __d('webzash', 'System Information'));

		return;
	}

	/* Authorization check */
	public function isAuthorized($user) {
		if ($this->action === 'index') {
			return $this->Permission->is_admin_allowed();
		}

		if ($this->action === 'edit') {
			return $this->Permission->is_admin_allowed();
		}

		if ($this->action === 'sysinfo') {
			return $this->Permission->is_admin_allowed();
		}

		return parent::isAuthorized($user);
	}
}
