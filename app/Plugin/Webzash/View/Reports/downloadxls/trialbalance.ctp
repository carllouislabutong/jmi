<?php


$xRS = '<Row>';
$xRE = '</Row>' . "\n";
$xCS = '<Cell><Data ss:Type="String">';
$xCE = '</Data></Cell>';

/**
 * Display chart of accounts
 *
 * @account AccountList group account
 * @c int counter for number of level deep the account is
 * @THIS this $this CakePHP object passed inside function
 */
function print_account_chart($account, $c = 0, $THIS)
{
	$xRS = '<Row>';
	$xRE = '</Row>' . "\n";
	$xCS = '<Cell><Data ss:Type="String">';
	$xCE = '</Data></Cell>';

	$counter = $c;

	/* Print groups */
	if ($account->id != 0) {
		echo $xRS;
		echo $xCS;
		echo print_space($counter);
		echo h(toCodeWithName($account->code, $account->name));
		echo $xCE;

		echo $xCS . __d('webzash', 'Group') . $xCE;

		echo $xCS . toCurrency($account->op_total_dc, $account->op_total) . $xCE;

		echo $xCS . toCurrency('D', $account->dr_total) . $xCE;

		echo $xCS . toCurrency('C', $account->cr_total) . $xCE;

		if ($account->cl_total_dc == 'D') {
			echo $xCS . toCurrency('D', $account->cl_total) . $xCE;
		} else {
			echo $xCS . toCurrency('C', $account->cl_total) . $xCE;
		}
		echo $xRE;
	}

	/* Print child ledgers */
	if (count($account->children_ledgers) > 0) {
		$counter++;
		foreach ($account->children_ledgers as $id => $data) {
			echo $xRS;
			echo $xCS;
			echo print_space($counter);
			echo h(toCodeWithName($data['code'], $data['name']));
			echo $xCE;

			echo $xCS . __d('webzash', 'Ledger') . $xCE;

			echo $xCS . toCurrency($data['op_total_dc'], $data['op_total']) . $xCE;

			echo $xCS . toCurrency('D', $data['dr_total']) . $xCE;

			echo $xCS . toCurrency('C', $data['cr_total']) . $xCE;

			if ($data['cl_total_dc'] == 'D') {
				echo $xCS . toCurrency('D', $data['cl_total']) . $xCE;
			} else {
				echo $xCS . toCurrency('C', $data['cl_total']) . $xCE;
			}
			echo $xRE;
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

echo $xRS . $xCS . $subtitle . $xCE . $xRE;
echo $xRS . $xRE;

echo $xRS;
echo $xCS . __d('webzash', 'Account Name') . $xCE;
echo $xCS . __d('webzash', 'Type') . $xCE;
echo $xCS . __d('webzash', 'O/P Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
echo $xCS . __d('webzash', 'Debit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
echo $xCS . __d('webzash', 'Credit Total') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
echo $xCS . __d('webzash', 'C/L Balance') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
echo $xRE;

print_account_chart($accountlist, -1, $this);

echo $xRS;
echo $xCS . __d('webzash', 'TOTAL') . $xCE;
echo $xCS . $xCE;
echo $xCS . $xCE;
echo $xCS . toCurrency('D', $accountlist->dr_total) . $xCE;
echo $xCS . toCurrency('C', $accountlist->cr_total) . $xCE;
echo $xRE;
