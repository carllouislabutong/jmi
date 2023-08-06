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
		echo '"';
		echo print_space($counter);
		echo h(toCodeWithName($account->code, $account->name));
		echo '",';

		echo '"' . __d('webzash', 'Group') . '",';

		echo '"' . toCurrency($account->op_total_dc, $account->op_total) . '",';

		echo '"' . toCurrency('D', $account->dr_total) . '",';

		echo '"' . toCurrency('C', $account->cr_total) . '",';

		if ($account->cl_total_dc == 'D') {
			echo '"' . toCurrency('D', $account->cl_total) . '"';
		} else {
			echo '"' . toCurrency('C', $account->cl_total) . '"';
		}
		echo "\n";
	}

	/* Print child ledgers */
	if (count($account->children_ledgers) > 0) {
		$counter++;
		foreach ($account->children_ledgers as $id => $data) {
			echo '"';
			echo print_space($counter);
			echo h(toCodeWithName($data['code'], $data['name']));
			echo '",';

			echo '"' . __d('webzash', 'Ledger') . '",';

			echo '"' . toCurrency($data['op_total_dc'], $data['op_total']) . '",';

			echo '"' . toCurrency('D', $data['dr_total']) . '",';

			echo '"' . toCurrency('C', $data['cr_total']) . '",';

			if ($data['cl_total_dc'] == 'D') {
				echo '"' . toCurrency('D', $data['cl_total']) . '"';
			} else {
				echo '"' . toCurrency('C', $data['cl_total']) . '"';
			}
			echo "\n";

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
		$html .= '      ';
	}
	return $html;
}

echo $subtitle;
echo "\n";
echo "\n";

echo '"' . __d('webzash', 'Account Name') . '",';
echo '"' . __d('webzash', 'Type') . '",';
echo '"' . __d('webzash', 'O/P Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '",';
echo '"' . __d('webzash', 'Debit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . '",';
echo '"' . __d('webzash', 'Credit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . '",';
echo '"' . __d('webzash', 'C/L Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . '"';
echo "\n";

print_account_chart($accountlist, -1, $this);

echo '"' . __d('webzash', 'TOTAL') . '",';
echo '"","",';
echo '"' . toCurrency('D', $accountlist->dr_total) . '",';
echo '"' . toCurrency('C', $accountlist->cr_total) . '",';
echo '""';
echo "\n";
