

<?php
	$xRS = '<Row>';
	$xRE = '</Row>' . "\n";
	$xCS = '<Cell><Data ss:Type="String">';
	$xCE = '</Data></Cell>';

	echo $xRS . $xCS . $subtitle . $xCE . $xRE;
	echo $xRS . $xRE;

	echo $xRS;
	echo $xCS . $opening_title . $xCE;
	echo $xCS . toCurrency($op['dc'], $op['amount']) . $xCE;
	echo $xRE;

	echo $xRS;
	echo $xCS . $closing_title . $xCE;
	echo $xCS . toCurrency($cl['dc'], $cl['amount']) . $xCE;
	echo $xRE;

	echo $xRS;
	echo $xCS . __d('webzash', 'Debit ') . $recpending_title . $xCE;
	echo $xCS . toCurrency('D', $rp['dr_total']) . $xCE;
	echo $xRE;

	echo $xRS;
	echo $xCS . __d('webzash', 'Credit ') . $recpending_title . $xCE;
	echo $xCS . toCurrency('C', $rp['cr_total']) . $xCE;
	echo $xRE;
	echo $xRS . $xRE;

	echo $xRS;
	echo $xCS . __d('webzash', 'Date') . $xCE;
	echo $xCS . __d('webzash', 'Number') . $xCE;
	echo $xCS . __d('webzash', 'Ledger') . $xCE;
	echo $xCS . __d('webzash', 'Type') . $xCE;
	echo $xCS . __d('webzash', 'Debit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
	echo $xCS . __d('webzash', 'Credit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . $xCE;
	echo $xCS . __d('webzash', 'Reconciliation Date') . $xCE;
	echo $xRE;

	/* Show the entries table */
	foreach ($entries as $row => $entry) {
		$entryTypeName = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.name');

		echo $xRS;
		echo $xCS . dateFromSql($entry['Entry']['date']) . $xCE;
		echo $xCS . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id'])) . $xCE;
		echo $xCS . h($this->Generic->entryLedgersReport($entry['Entry']['id'])) . $xCE;
		echo $xCS . h($entryTypeName) . $xCE;

		if ($entry['Entryitem']['dc'] == 'D') {
			echo $xCS . toCurrency('D', $entry['Entryitem']['amount']) . $xCE;
			echo $xCS . $xCE;
		} else if ($entry['Entryitem']['dc'] == 'C') {
			echo $xCS . $xCE;
			echo $xCS . toCurrency('C', $entry['Entryitem']['amount']) . $xCE;
		} else {
			echo $xCS . __d('webzash', 'ERROR') . $xCE;
			echo $xCS . __d('webzash', 'ERROR') . $xCE;
		}

		if ($entry['Entryitem']['reconciliation_date']) {
			echo $xCS . dateFromSql($entry['Entryitem']['reconciliation_date']) . $xCE;
		} else {
			echo $xCS . $xCE;
		}
		echo $xRE;
	}
