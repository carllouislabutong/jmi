

<script type="text/javascript">
$(document).ready(function() {

	/* Calculate date range in javascript */
	fromDate = new Date(<?php echo strtotime(Configure::read('Account.startdate')) * 1000; ?>  + (new Date().getTimezoneOffset() * 60 * 1000));
	toDate = new Date(<?php echo strtotime(Configure::read('Account.enddate')) * 1000; ?>  + (new Date().getTimezoneOffset() * 60 * 1000));

	/* Setup jQuery datepicker ui */
	$('#SearchFromdate').datepicker({
		minDate: fromDate,
		maxDate: toDate,
		dateFormat: '<?php echo Configure::read('Account.dateformatJS'); ?>',
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			if (selectedDate) {
				$("#SearchTodate").datepicker("option", "minDate", selectedDate);
			} else {
				$("#SearchTodate").datepicker("option", "minDate", fromDate);
			}
		}
	});
	$('#SearchTodate').datepicker({
		minDate: fromDate,
		maxDate: toDate,
		dateFormat: '<?php echo Configure::read('Account.dateformatJS'); ?>',
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			if (selectedDate) {
				$("#SearchFromdate").datepicker("option", "maxDate", selectedDate);
			} else {
				$("#SearchFromdate").datepicker("option", "maxDate", toDate);
			}
		}
	});

        $('#SearchEntrynumberRestriction').on('change', function() {
                if (this.value == 4) {
                        $('.entrynumber-in-between').show();
                } else {
                        $('.entrynumber-in-between').hide();
                }
        });

        $('#SearchAmountRestriction').on('change', function() {
                if (this.value == 4) {
                        $('.amount-in-between').show();
                } else {
                        $('.amount-in-between').hide();
                }
        });

	/* On page load initiate all triggers */
        $('#SearchEntrynumberRestriction').trigger('change');
	$('#SearchAmountRestriction').trigger('change');

	$(".ledger-dropdown").select2({width:'100%'});
	$(".entrytype-dropdown").select2({width:'100%'});
	$(".tag-dropdown").select2({width:'100%'});
});
</script>
<style>
	*{
		color: black;
	}
	label {
		color: white;
	}
</style>
<div class="search form">
	<?php
		echo $this->Form->create('Search', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->input('ledger_ids', array(
			
                        'type' => 'select',
			'escape' => false,
                        'options' => $ledger_options,
			'disabled' => $ledgers_disabled,
                        'multiple' => true,
			'class' => 'ledger-dropdown form-control',
			'default' => 0,
                        'label' => __d('webzash', 'Ledgers')
                ));

		echo $this->Form->input('entrytype_ids', array(
                        'type' => 'select',
                        'options' => $entrytype_options,
                        'multiple' => true,
			'class' => 'entrytype-dropdown form-control',
			'default' => 0,
                        'label' => __d('webzash', 'Entrytypes')
                ));

		echo $this->Form->label(__d('webzash', 'Entry number'));
		echo '<table>';
		echo '<tr class="table-top">';
		echo '<td>' . $this->Form->input('entrynumber_restriction', array(
                        'type' => 'select',
                        'options' => $this->Generic->search_range_options(),
                        'label' => false,
                )) . '</td>';
		echo '<td>' . $this->Form->input('entrynumber1', array(
			'label' => false,
			'required' => false,
			)) . '</td>';
                echo '<td width="1" class="entrynumber-in-between">' . __d('webzash', 'and') . '</td>';
		echo '<td class="entrynumber-in-between">' . $this->Form->input('entrynumber2', array(
			'label' => false,
			'required' => false,
			)) . '</td>';
		echo '</tr>';
		echo '</table>';

		echo $this->Form->input('amount_dc', array(
                        'type' => 'select',
                        'options' => array('0' => '(ANY)', 'D' => 'Dr', 'C' => 'Cr'),
                        'label' => __d('webzash', 'Dr or Cr')
                ));

		echo $this->Form->label(__d('webzash', 'Amount'));
		echo '<table>';
		echo '<tr class="table-top">';
		echo '<td>' . $this->Form->input('amount_restriction', array(
                        'type' => 'select',
                        'options' => $this->Generic->search_range_options(),
                        'label' => false,
                )) . '</td>';
		echo '<td>' . $this->Form->input('amount1', array(
			'label' => false,
			'required' => false,
			)) . '</td>';
                echo '<td width="1" class="amount-in-between">' . __d('webzash', 'and') . '</td>';
		echo '<td class="amount-in-between">' . $this->Form->input('amount2', array(
			'label' => false,
			'required' => false,
			)) . '</td>';
		echo '</tr>';
		echo '</table>';

		echo $this->Form->input('fromdate', array('label' => __d('webzash', 'From date')));
		echo $this->Form->input('todate', array('label' => __d('webzash', 'To date')));

		echo $this->Form->input('tag_ids', array(
                        'type' => 'select',
                        'options' => $tag_options,
                        'multiple' => true,
			'class' => 'tag-dropdown form-control',
			'default' => 0,
                        'label' => __d('webzash', 'Tags')
                ));

                echo $this->Form->input('narration', array('label' => __d('webzash', 'Narration contains')));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Search'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Clear'), array('plugin' => 'webzash', 'controller' => 'search', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>

<?php if ($showEntries) { ?>

	<table class="stripped">

	<tr>
	<th><?php echo $this->Paginator->sort('date', __d('webzash', 'Date')); ?></th>
	<th><?php echo $this->Paginator->sort('number', __d('webzash', 'Number')); ?></th>
	<th><?php echo __d('webzash', 'Ledger'); ?></th>
	<th><?php echo $this->Paginator->sort('entrytype_id', __d('webzash', 'Type')); ?></th>
	<th><?php echo $this->Paginator->sort('tag_id', __d('webzash', 'Tag')); ?></th>
	<th><?php echo __d('webzash', 'Debit Amount'); ?><?php echo ' (' . Configure::read('Account.currency_symbol') . ')'; ?></th>
	<th><?php echo __d('webzash', 'Credit Amount'); ?><?php echo ' (' . Configure::read('Account.currency_symbol') . ')'; ?></th>
	<th><?php echo __d('webzash', 'Actions'); ?></th>
	</tr>

	<?php
	/* Show the entries table */
	foreach ($entries as $entry) {
		$entryTypeName = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.name');
		$entryTypeLabel = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.label');
		echo '<tr valign="top">';
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
		echo '<td>' . $this->Generic->showTag($entry['Entry']['tag_id'])  . '</td>';

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
		echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-log-in')) . __d('webzash', ' View'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'view', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'edit', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'delete', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the entry ?')));
		echo '</td>';
		echo '</tr>';
	}
	?>

	</table>

	<div class="text-center paginate">
		<ul class="pagination">
			<?php
				echo $this->Paginator->first(__d('webzash', 'first'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				echo $this->Paginator->prev(__d('webzash', 'prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
				echo $this->Paginator->next(__d('webzash', 'next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				echo $this->Paginator->last(__d('webzash', 'last'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			?>
		</ul>
	</div>
<?php }
