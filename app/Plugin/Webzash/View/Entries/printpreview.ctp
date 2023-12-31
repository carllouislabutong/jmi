
<html>

<body>

<div>

<div>
<h3><?php echo h(Configure::read('Account.name')); ?></h3>
<p><?php echo nl2br(h(Configure::read('Account.address'))); ?></p>
<h5><?php echo h($entrytype['Entrytype']['name']) . ' ' . __d('webzash', 'Entry'); ?></h5>
</div>

<?php
	echo __d('webzash', 'Number') . ' : ' . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id']));
	echo '<br /><br />';
	echo __d('webzash', 'Date') . ' : ' . h(dateFromSql($entry['Entry']['date']));
	echo '<br /><br />';

	echo '<table border="1">';

	/* Header */
	echo '<tr>';
	if ($this->Session->read('Wzsetting.drcr_toby') == 'toby') {
		echo '<th>' . __d('webzash', 'To/By') . '</th>';
	} else {
		echo '<th>' . __d('webzash', 'Dr/Cr') . '</th>';
	}
	echo '<th>' . __d('webzash', 'Ledger') . '</th>';
	echo '<th>' . __d('webzash', 'Dr Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '<th>' . __d('webzash', 'Cr Amount') . ' (' . Configure::read('Account.currency_symbol') . ')' . '</th>';
	echo '</tr>';

	/* Intial rows */
	foreach ($entryitems as $row => $entryitem) {
		echo '<tr>';

		echo '<td>';
		if ($this->Session->read('Wzsetting.drcr_toby') == 'toby') {
			if ($entryitem['dc'] == 'D') {
				echo 'By';
			} else {
				echo 'To';
			}
		} else {
			if ($entryitem['dc'] == 'D') {
				echo 'Dr';
			} else {
				echo 'Cr';
			}
		}
		echo '</td>';

		echo '<td>';
		echo h($entryitem['ledger_name']);
		echo '</td>';

		echo '<td>';
		if ($entryitem['dc'] == 'D') {
			echo $entryitem['dr_amount'];
		} else {
			echo '';
		}
		echo '</td>';

		echo '<td>';
		if ($entryitem['dc'] == 'C') {
			echo $entryitem['cr_amount'];
		} else {
			echo '';
		}
		echo '</td>';
		echo '</tr>';
	}

	/* Total */
	echo '<tr>' . '<td></td>' . '<td>' . __d('webzash', 'Total') . '</td>' . '<td id="dr-total">' . toCurrency('D', $entry['Entry']['dr_total']) . '</td>' . '<td id="cr-total">' . toCurrency('C', $entry['Entry']['cr_total']) . '</td>' . '</tr>';

	/* Difference */
	if (calculate($entry['Entry']['dr_total'], $entry['Entry']['cr_total'], '==')) {
		/* Do nothing */
	} else {
		if (calculate($entry['Entry']['dr_total'], $entry['Entry']['cr_total'], '>')) {
			echo '<tr>' . '<td></td>' . '<td>' . __d('webzash', 'Difference') . '</td>' . '<td id="dr-diff">' . toCurrency('D', calculate($entry['Entry']['dr_total'], $entry['Entry']['cr_total'], '-')) . '</td>' . '<td></td>' . '</tr>';
		} else {
			echo '<tr>' . '<td></td>' . '<td>' . __d('webzash', 'Difference') . '</td>' . '<td></td>' . '<td id="cr-diff">' . toCurrency('C', calculate($entry['Entry']['cr_total'], $entry['Entry']['dr_total'], '-')) . '</td>' . '</tr>';

		}
	}

	echo '</table>';
	echo '<br />';

	echo __d('webzash', 'Narration') . ' : ' . h($entry['Entry']['narration']);
	echo '<br /><br />';
?>

<form>
<input class="hide-print" type="button" onClick="window.print()" value="Print">
</form>

</div>

</body>

</html>
