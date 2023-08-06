

<script type="text/javascript">
$(document).ready(function() {
	/**
	 * On changing the parent group select box check whether the selected value
	 * should show the "Affects Gross Profit/Loss Calculations".
	 */
	$('#GroupParentId').change(function() {
		if ($(this).val() == '3' || $(this).val() == '4') {
			$('#AffectsGross').show();
		} else {
			$('#AffectsGross').hide();
		}
	});
	$('#GroupParentId').trigger('change');

	$("#GroupParentId").select2({width:'100%'});
});
</script>

<style type="text/css">
.select2-container--default .select2-results__option {
	font-weight: bold;
	color: #333;
}
</style>

<div class="groups edit form">
	<?php
		echo $this->Form->create('Group', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->input('name', array('label' => __d('webzash', 'Group name')));
		echo $this->Form->input('code', array('label' => __d('webzash', 'Group code (optional)')));
		echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $parents, 'escape' => false, 'value' => $this->data['Group']['parent_id'], 'label' => __d('webzash', 'Parent group')));

		echo $this->Form->input('affects_gross', array(
			'type' => 'radio',
			'options' => $this->Generic->group_netgross_options(),
			'default' => 1,
			'before' => '<label class="control-label">' . __d('webzash', 'Affects') . '</label>',
			'legend' => false,
			'class' => 'radio',
			'div' => array('class' => 'form-group required', 'id' => 'AffectsGross'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Changes to whether it affects Gross or Net Profit & Loss is reflected in final Profit & Loss statement.') . '</span>',
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
