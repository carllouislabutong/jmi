<?php


App::uses('WebzashAppController', 'Webzash.Controller');

/**
 * Webzash Plugin Logs Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class LogsController extends WebzashAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->set('title_for_layout', __d('webzash', 'Logs'));

		$this->set('actionlinks', array(
			array('controller' => 'logs', 'action' => 'clear', 'title' => __d('webzash', 'Clear Logs')),
			array('controller' => 'dashboard', 'action' => 'index', 'title' => __d('webzash', 'Back')),
		));

		$this->CustomPaginator->settings = array(
			'Log' => array(
				'limit' => 50,
				'order' => array('Log.date' => 'asc'),
			)
		);

		$this->set('logs', $this->CustomPaginator->paginate('Log'));
		return;
	}

	public function clear() {

		if ($this->Log->deleteAll(array('1 = 1'))) {
			$this->Session->setFlash(__d('webzash', 'Logs cleared.'), 'success');
		} else {
			$this->Session->setFlash(__d('webzash', 'Failed to clear logs. Please, try again.'), 'danger');
		}

		return $this->redirect(array('plugin' => 'webzash', 'controller' => 'dashboard', 'action' => 'index'));
	}

	function beforeFilter() {
		parent::beforeFilter();

		/* Check if acccount is locked */
		if (Configure::read('Account.locked') == 1) {
			if ($this->action == 'clear') {
				$this->Session->setFlash(__d('webzash', 'Sorry, no changes are possible since the account is locked.'), 'danger');
				return $this->redirect(array('plugin' => 'webzash', 'controller' => 'logs', 'action' => 'index'));
			}
		}
	}

	/* Authorization check */
	public function isAuthorized($user) {
		if ($this->action === 'index') {
			return $this->Permission->is_allowed('view log');
		}

		if ($this->action === 'clear') {
			return $this->Permission->is_allowed('clear log');
		}

		return parent::isAuthorized($user);
	}
}
