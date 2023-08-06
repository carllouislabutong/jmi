
<div class="wzusers login form">
<?php
	echo $this->Form->create('Wzuser', array(
		'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control',
		),
	));

	echo $this->Form->input('username', array('label' => __d('webzash', 'Username')));
	echo $this->Form->input('password', array('label' => __d('webzash', 'Password')));

	echo '<div class="form-group">';
	echo $this->Form->submit(__d('webzash', 'Login'), array(
	'div' => false,
	'class' => 'btn btn-primary'
	));
	echo '</div>';

	echo $this->Form->end();
?>
</div>
