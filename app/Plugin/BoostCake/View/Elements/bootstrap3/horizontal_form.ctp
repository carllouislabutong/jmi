<?php echo $this->Form->create('BoostCake', array(
	'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<?php echo $this->Form->input('email', array(
		'placeholder' => 'Email'
	)); ?>
	<?php echo $this->Form->input('password', array(
		'placeholder' => 'Password'
	)); ?>
	<?php echo $this->Form->input('remember', array(
		'wrapInput' => 'col col-md-9 col-md-offset-3',
		'label' => 'Remember me',
		'class' => false
	)); ?>
	<div class="form-group">
		<?php echo $this->Form->submit('Sign in', array(
			'div' => 'col col-md-9 col-md-offset-3',
			'class' => 'btn btn-default'
		)); ?>
	</div>
<?php echo $this->Form->end(); ?>