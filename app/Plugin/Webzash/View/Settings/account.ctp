

<script type="text/javascript">
$(document).ready(function() {
	/* Setup jQuery datepicker ui */
	$('#SettingFyStart').datepicker({
		dateFormat: $("#SettingDateFormat").val().split('|')[1],	/* Read the Javascript date format value */
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			$("#SettingFyEnd").datepicker("option", "minDate", selectedDate);
		}
	});
	$('#SettingFyEnd').datepicker({
		dateFormat: $("#SettingDateFormat").val().split('|')[1],	/* Read the Javascript date format value */
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			$("#SettingFyStart").datepicker("option", "maxDate", selectedDate);
		}
	});

	$("#SettingDateFormat").change(function() {
		/* Read the Javascript date format value */
		dateFormat = $(this).val().split('|')[1];
		$("#SettingFyStart").datepicker("option", "dateFormat", dateFormat);
		$("#SettingFyEnd").datepicker("option", "dateFormat", dateFormat);
	});
});
</script>

<div class="account form">
<?php
	echo $this->Form->create('Setting', array(
		'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control',
		),
	));

	echo $this->Form->input('name', array('label' => __d('webzash', 'Company / Personal Name')));
	echo $this->Form->input('address', array('type' => 'textarea', 'label' => __d('webzash', 'Address and other details'), 'rows' => '4'));
	echo $this->Form->input('email', array('label' => __d('webzash', 'Email')));
	echo $this->Form->input('currency_symbol', array('label' => __d('webzash', 'Currency symbol')));
	echo $this->Form->input('currency_format', array('type' => 'select', 'options' => $this->Generic->currency_format_options(), 'label' => __d('webzash', 'Currency format')));
	echo $this->Form->input('date_format', array('type' => 'select', 'options' => $this->Generic->dateformat_options(), 'label' => __d('webzash', 'Date format')));
	echo $this->Form->input('fy_start', array('type' => 'text', 'label' => __d('webzash', 'Financial year start')));
	echo $this->Form->input('fy_end', array('type' => 'text', 'label' => __d('webzash', 'Financial year end')));

	echo '<div class="form-group">';
	echo $this->Form->submit(__d('webzash', 'Submit'), array(
		'div' => false,
		'class' => 'btn btn-primary'
	));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'index'), array('class' => 'btn btn-default'));
	echo '</div>';

	echo $this->Form->end();
?>
</div>
