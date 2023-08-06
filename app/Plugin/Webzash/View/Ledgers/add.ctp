

<script type="text/javascript">
$(document).ready(function() {
	$("#LedgerGroupId").select2({width:'100%'});
});
</script>

<style type="text/css">
.select2-container--default .select2-results__option {
	font-weight: bold;
	color: #333;
}
</style>

<div class="ledgers add form">
	<?php
		echo $this->Form->create('Ledger', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->input('name', array('label' => __d('webzash', 'Ledger name')));
		echo $this->Form->input('code', array('label' => __d('webzash', 'Ledger code (optional)')));
		echo $this->Form->input('group_id', array('type' => 'select', 'options' => $parents, 'escape' => false, 'label' => __d('webzash', 'Parent group')));

		echo $this->Form->label(__d('webzash', 'Opening balance'));
		echo '<table>';
		echo '<tr class="table-top">';
		echo '<td class="width-drcr">' . $this->Form->input('op_balance_dc', array('type' => 'select', 'options' => array('D' => 'Dr', 'C' => 'Cr'), 'label' => false)) . '</td>';
		echo '<td>' . $this->Form->input('op_balance', array(
			'label' => false,
			'required' => false,
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Assets / Expenses always have Dr balance and Liabilities / Incomes always have Cr balance.') . '</span>',
			)) . '</td>';
		echo '</tr>';
		echo '</table>';

		echo $this->Form->input('type', array(
			'type' => 'checkbox',
			'label' => __d('webzash', 'Bank or cash account'),
			'class' => 'checkbox',
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Select if the ledger account is a bank or a cash account.') . '</span>',
		));

		echo $this->Form->input('reconciliation', array(
			'type' => 'checkbox',
			'label' => __d('webzash', 'Reconciliation'),
			'class' => 'checkbox',
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : If selected the ledger account can be reconciled from Reports > Reconciliation.') . '</span>',
		));

		echo $this->Form->input('notes', array(
			'type' => 'textarea',
			'label' => __d('webzash', 'Notes'),
			'rows' => '3',
		));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'accounts', 'action' => 'show'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
