

<?php if ($showEntries) { ?>

<div class="subtitle">
	<?php
	if (Configure::read('Account.name')) {
		echo '<div>' . h(Configure::read('Account.name')) . '</div>';
	}
	?>
	<?php echo $subtitle; ?>
</div>

	<table class="summary stripped table-condensed">
		<tr>
			<td><?php echo $opening_title; ?></td>
			<td><?php echo toCurrency($op['dc'], $op['amount']); ?></td>
		</tr>
		<tr>
			<td><?php echo $closing_title; ?></td>
			<td><?php echo toCurrency($cl['dc'], $cl['amount']); ?></td>
		</tr>
		<tr>
			<td><?php echo __d('webzash', 'Debit ') . $recpending_title; ?></td>
			<td><?php echo toCurrency('D', $rp['dr_total']); ?></td>
		</tr>
		<tr>
			<td><?php echo __d('webzash', 'Credit ') . $recpending_title; ?></td>
			<td><?php echo toCurrency('C', $rp['cr_total']); ?></td>
		</tr>
	</table>
	<br />

<div class="reconciliation form">

	<table class="stripped">

	<tr>
	<th><?php echo __d('webzash', 'Date'); ?></th>
	<th><?php echo __d('webzash', 'Number'); ?></th>
	<th><?php echo __d('webzash', 'Ledger'); ?></th>
	<th><?php echo __d('webzash', 'Type'); ?></th>
	<th><?php echo __d('webzash', 'Tag'); ?></th>
	<th><?php echo __d('webzash', 'Debit Amount'); ?><?php echo ' (' . Configure::read('Account.currency_symbol') . ')'; ?></th>
	<th><?php echo __d('webzash', 'Credit Amount'); ?><?php echo ' (' . Configure::read('Account.currency_symbol') . ')'; ?></th>
	<th><?php echo __d('webzash', 'Reconciliation Date'); ?></th>
	</tr>

	<?php
	/* Show the entries table */
	foreach ($entries as $row => $entry) {
		$entryTypeName = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.name');
		echo '<tr>';
		echo '<td>' . dateFromSql($entry['Entry']['date']) . '</td>';
		echo '<td>' . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id'])) . '</td>';

		echo '<td>';
		echo $this->Generic->entryLedgers($entry['Entry']['id'], $entry['Entryitem']['id']);
		if (strlen($entry['Entry']['narration']) > 0) {
			if (strlen($entry['Entry']['narration']) > 60) {
				echo $this->Html->tag('span', substr(h($entry['Entry']['narration']), 0, 60) . '...', array('class' => 'text-small'));
			} else {
				echo $this->Html->tag('span', substr(h($entry['Entry']['narration']), 0, 60), array('class' => 'text-small'));
			}
		}
		echo '</td>';

		echo '<td>' . h($entryTypeName) . '</td>';
		echo '<td>' . $this->Generic->showTag($entry['Entry']['tag_id']) . '</td>';

		if ($entry['Entryitem']['dc'] == 'D') {
			echo '<td>' . toCurrency('D', $entry['Entryitem']['amount']) . '</td>';
			echo '<td>' . '</td>';
		} else if ($entry['Entryitem']['dc'] == 'C') {
			echo '<td>' . '</td>';
			echo '<td>' . toCurrency('C', $entry['Entryitem']['amount']) . '</td>';
		} else {
			echo '<td>' . __d('webzash', 'ERROR') . '</td>';
			echo '<td>' . __d('webzash', 'ERROR') . '</td>';
		}

		echo '<td>';
		if ($entry['Entryitem']['reconciliation_date']) {
			echo dateFromSql($entry['Entryitem']['reconciliation_date']);
		} else {
			echo '';
		}
		echo '</td>';
		echo '</tr>';
	}
	?>
	</table>
	<br />

<?php }
