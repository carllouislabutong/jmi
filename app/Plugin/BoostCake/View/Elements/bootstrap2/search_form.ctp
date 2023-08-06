<?php echo $this->Form->create('BoostCake', array(
	'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
	'inputDefaults' => array(
		'div' => false,
		'wrapInput' => false
	),
	'class' => 'well form-search'
)); ?>
	<?php echo $this->Form->input('text', array(
		'label' => false,
		'class' => 'input-medium search-query',
	)); ?>
	<?php echo $this->Form->submit('Search', array(
		'div' => false,
		'class' => 'btn'
	)); ?>
<?php echo $this->Form->end(); ?>