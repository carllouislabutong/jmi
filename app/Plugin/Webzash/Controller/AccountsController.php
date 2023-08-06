<?php


App::uses('WebzashAppController', 'Webzash.Controller');
App::uses('AccountList', 'Webzash.Lib');

/**
 * Webzash Plugin Accounts Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class AccountsController extends WebzashAppController {

	public $uses = array('Webzash.Group', 'Webzash.Ledger');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		return $this->redirect(array('plugin' => 'webzash', 'controller' => 'accounts', 'action' => 'show'));
	}

/**
 * show method
 *
 * @return void
 */
	public function show() {

		$this->set('title_for_layout', __d('webzash', 'Chart Of Accounts'));

		$this->set('actionlinks', array(
			array('controller' => 'groups', 'action' => 'add', 'title' => 'Add Group'),
			array('controller' => 'ledgers', 'action' => 'add', 'title' => 'Add Ledger')
		));
		$accountlist = new AccountList();
		$accountlist->Group = &$this->Group;
		$accountlist->Ledger = &$this->Ledger;
		$accountlist->only_opening = false;
		$accountlist->start_date = null;
		$accountlist->end_date = null;
		$accountlist->affects_gross = -1;
		$accountlist->start(0);

		$this->set('accountlist', $accountlist);

		$opdiff = $this->Ledger->getOpeningDiff();
		$this->set('opdiff', $opdiff);

		return;
	}

	/* Authorization check */
	public function isAuthorized($user) {
		if ($this->action === 'show') {
			return $this->Permission->is_allowed('view accounts chart');
		}

		return parent::isAuthorized($user);
	}

}
