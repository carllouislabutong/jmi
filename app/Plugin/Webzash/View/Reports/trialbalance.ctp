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

		echo '<td>' . toCurrency('D', $account->dr_total) . '</td>';

		echo '<td>' . toCurrency('C', $account->cr_total) . '</td>';

		if ($account->cl_total_dc == 'D') {
			echo '<td>' . toCurrency('D', $account->cl_total) . '</td>';
		} else {
			echo '<td>' . toCurrency('C', $account->cl_total) . '</td>';
		}

		echo '</tr>';
	}

	/* Print child ledgers */
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

			echo '<td>' . toCurrency('D', $data['dr_total']) . '</td>';

			echo '<td>' . toCurrency('C', $data['cr_total']) . '</td>';

			if ($data['cl_total_dc'] == 'D') {
				echo '<td>' . toCurrency('D', $data['cl_total']) . '</td>';
			} else {
				echo '<td>' . toCurrency('C', $data['cl_total']) . '</td>';
			}

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
?>

<?php
	echo '<div class="btn-group" role="group">';

	echo $this->Html->link(
		__d('webzash', 'DOWNLOAD .CSV'),
		'/' . $this->params->url . '/downloadcsv:true',
		array('class' => 'btn btn-default btn-sm')
	);

	echo $this->Html->link(
		__d('webzash', 'DOWNLOAD .XLS'),
		'/' . $this->params->url . '/downloadxls:true',
		array('class' => 'btn btn-default btn-sm')
	);

	echo $this->Html->link(__d('webzash', 'PRINT'), '',
		array(
			'class' => 'btn btn-default btn-sm',
			'onClick' => "window.open('" . $this->Html->url('/' . $this->params->url . '/print:true') . "', 'windowname','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=1000,height=600'); return false;"
		)
	);

	echo '</div>';
	echo '<br /><br />';
?>

<div class="subtitle text-center">
	<?php
	if (Configure::read('Account.name')) {
		echo '<div>' . h(Configure::read('Account.name')) . '</div>';
	}
	?>
	<?php echo $subtitle; ?>
</div>

<?php
echo '<table class="stripped">';
	echo '<th>' . __d('webzash', 'Account Name') . '</th>';
	echo '<th>' . __d('webzash', 'Type') . '</th>';
	echo '<th>' . __d('webzash', 'O/P Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'Debit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'Credit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'C/L Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';

	print_account_chart($accountlist, -1, $this);

	if (calculate($accountlist->dr_total, $accountlist->cr_total, '==')) {
		echo '<tr class="bold-text ok-text">';
	} else {
		echo '<tr class="bold-text error-text">';
	}
	echo '<td>' . __d('webzash', 'TOTAL') . '</td>';
	echo '<td></td><td></td>';
	echo '<td>' . toCurrency('D', $accountlist->dr_total) . '</td>';
	echo '<td>' . toCurrency('C', $accountlist->cr_total) . '</td>';
	if (calculate($accountlist->dr_total, $accountlist->cr_total, '==')) {
		echo '<td><span class="glyphicon glyphicon-ok-sign"></span></td>';
	} else {
		echo '<td><span class="glyphicon glyphicon-remove-sign"></span></td>';
	}
	echo '<td></td>';
	echo '</tr>';

echo '</table>';
