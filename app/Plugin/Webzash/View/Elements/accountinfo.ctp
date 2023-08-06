<?php


if ($this->Session->read('ActiveAccount.id')) {
	if (Configure::read('Account.name')) {
		echo h(Configure::read('Account.name'));
		echo ' ';
		echo $this->Html->link(__d('webzash', '(change)'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'account'));
		echo '<br />';
		echo dateFromSql(Configure::read('Account.startdate')) . ' to ' . dateFromSql(Configure::read('Account.enddate'));
	}
}
