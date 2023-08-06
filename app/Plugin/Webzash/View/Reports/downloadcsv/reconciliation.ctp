

<?php
	echo $subtitle;
	echo "\n";
	echo "\n";

	echo '"' . $opening_title . '",';
	echo '"' . toCurrency($op['dc'], $op['amount']) . '"';
	echo "\n";
	echo '"' . $closing_title . '",';
	echo '"' . toCurrency($cl['dc'], $cl['amount']) . '"';
	echo "\n";
	echo '"' . __d('webzash', 'Debit ') . $recpending_title . '",';
	echo '"' . toCurrency('D', $rp['dr_total']) . '"';
	echo "\n";
	echo '"' . __d('webzash', 'Credit ') . $recpending_title . '",';
	echo '"' . toCurrency('C', $rp['cr_total']) . '"';
	echo "\n";
	echo "\n";

	echo '"' . __d('webzash', 'Date') . '",';
	echo '"' . __d('webzash', 'Number') . '",';
	echo '"' . __d('webzash', 'Ledger') . '",';
	echo '"' . __d('webzash', 'Type') . '",';
	echo '"' . __d('webzash', 'Debit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . '",';
	echo '"' . __d('webzash', 'Credit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . '",';
	echo '"' . __d('webzash', 'Reconciliation Date') . '"';
	echo "\n";

	/* Show the entries table */
	foreach ($entries as $row => $entry) {
		$entryTypeName = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.name');
		echo '"' . dateFromSql($entry['Entry']['date']) . '",';
		echo '"' . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id'])) . '",';
		echo '"' . h($this->Generic->entryLedgersReport($entry['Entry']['id'])) . '",';
		echo '"' . h($entryTypeName) . '",';

		if ($entry['Entryitem']['dc'] == 'D') {
			echo '"' . toCurrency('D', $entry['Entryitem']['amount']) . '",';
			echo '"",';
		} else if ($entry['Entryitem']['dc'] == 'C') {
			echo '"",';
			echo '"' . toCurrency('C', $entry['Entryitem']['amount']) . '",';
		} else {
			echo '"' . __d('webzash', 'ERROR') . '",';
			echo '"' . __d('webzash', 'ERROR') . '",';
		}

		if ($entry['Entryitem']['reconciliation_date']) {
			echo '"' . dateFromSql($entry['Entryitem']['reconciliation_date']) . '"';
		} else {
			echo '""';
		}
		echo "\n";
	}
