<?php echo $this->Form->create('BoostCake', array(
	'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
	<fieldset>
		<legend>Legend</legend>
		<?php echo $this->Form->input('text', array(
			'label' => 'Label name',
			'placeholder' => 'Type something…',
			'after' => '<span class="help-block">Example block-level help text here.</span>'
		)); ?>
		<?php echo $this->Form->input('checkbox', array(
			'label' => 'Check me out',
			'class' => false
		)); ?>
		<?php echo $this->Form->submit('Submit', array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>