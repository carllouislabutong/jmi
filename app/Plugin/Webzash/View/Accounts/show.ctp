<?php


/**
 * Display chart of accounts
 *
 * @account AccountList group account
 * @c int counter for number of level deep the account is
 * @THIS this $this CakePHP object passed inside function
 */
function print_account_chart($account, $c = 0, $THIS)
{
	$counter = $c;
	// disply acc groups info
	/* Print groups */
	if ($account->id != 0) {
		if ($account->id <= 4) {
			echo '<tr class="tr-group tr-root-group">';
		} else {
			echo '<tr class="tr-group">';
		}
		echo '<td class="td-group">';
		echo print_space($counter);
		echo h(toCodeWithName($account->code, $account->name));
		echo '</td>';

		echo '<td>Group</td>';

		echo '<td>';
		echo toCurrency($account->op_total_dc, $account->op_total);
		echo '</td>';

		echo '<td>';
		echo toCurrency($account->cl_total_dc, $account->cl_total);
		echo '</td>';

		/* If group id less than 4 dont show edit and delete links */
		if ($account->id <= 4) {
			echo '<td class="td-actions"></td>';
		} else {
			echo '<td class="td-actions">';
			echo $THIS->Html->link($THIS->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'groups', 'action' => 'edit', $account->id), array('class' => 'no-hover font-normal', 'escape' => false));
			echo $THIS->Html->tag('span', '', array('class' => 'link-pad'));
			echo $THIS->Form->postLink($THIS->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'groups', 'action' => 'delete', $account->id), array('class' => 'no-hover font-normal', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the group ?')));
			echo '</td>';
		}
		echo '</tr>';
	}

	/* Print child ledgers */
	// $THIS->Html->link cakephp helper function display link or hyper link
	// $THIS->Form->postLink generate post request
	if (count($account->children_ledgers) > 0) {
		$counter++;
		foreach ($account->children_ledgers as $id => $data) {
			echo '<tr class="tr-ledger">';
			echo '<td class="td-ledger">';
			echo print_space($counter);
			echo $THIS->Html->link(toCodeWithName($data['code'], $data['name']), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'ledgerstatement', 'ledgerid' => $data['id']));
			echo '</td>';
			echo '<td>Ledger</td>';

			echo '<td>';
			echo toCurrency($data['op_total_dc'], $data['op_total']);
			echo '</td>';

			echo '<td>';
			echo toCurrency($data['cl_total_dc'], $data['cl_total']);
			echo '</td>';

			echo '<td class="td-actions">';
			echo $THIS->Html->link($THIS->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'ledgers', 'action' => 'edit', $data['id']), array('class' => 'no-hover', 'escape' => false));
			echo $THIS->Html->tag('span', '', array('class' => 'link-pad'));
			echo $THIS->Form->postLink($THIS->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'ledgers', 'action' => 'delete', $data['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the ledger ?')));
			echo '</td>';

			echo '</tr>';
		}
		$counter--;
	}

	/* Print child groups recursively */
	foreach ($account->children_groups as $id => $data) {
		$counter++;
		print_account_chart($data, $counter, $THIS);
		$counter--;
	}
}

function print_space($count)
{
	$html = '';
	for ($i = 1; $i <= $count; $i++) {
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	return $html;
}

if (calculate($opdiff['opdiff_balance'], 0, '!=')) {
	echo '<div><div role="alert" class="alert alert-danger">' .
		__d('webzash', 'There is a difference in opening balance of ') .
		toCurrency($opdiff['opdiff_balance_dc'], $opdiff['opdiff_balance']) .
		'</div></div>';
}
// custom css
// __d function will look up the translated version of the string and return it
echo '<table class="stripped">';
	echo '<th>' . __d('webzash', 'Account Name') . '</th>';
	echo '<th>' . __d('webzash', 'Type') . '</th>';
	echo '<th>' . __d('webzash', 'O/P Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'C/L Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'Actions') . '</th>';
	print_account_chart($accountlist, -1, $this);
echo '</table>';
