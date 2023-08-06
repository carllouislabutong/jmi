<?php echo $this->Form->create('BoostCake', array(
	'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
	'inputDefaults' => array(
		'div' => false,
		'label' => false,
		'wrapInput' => false
	),
	'class' => 'well form-inline'
)); ?>
	<?php echo $this->Form->input('email', array(
		'class' => 'input-small',
		'placeholder' => 'Email'
	)); ?>
	<?php echo $this->Form->input('password', array(
		'class' => 'input-small',
		'placeholder' => 'Password'
	)); ?>
	<?php echo $this->Form->input('remember', array(
		'label' => array(
			'text' => 'Remember me',
			'class' => 'checkbox'
		),
		'checkboxDiv' => false
	)); ?>
	<?php echo $this->Form->submit('Sign in', array(
		'div' => false,
		'class' => 'btn'
	)); ?>
<?php echo $this->Form->end(); ?>