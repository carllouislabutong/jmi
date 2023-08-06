
<div class="wzusers login form">
<?php
	if ($first_login) {
		echo '<div class="alert alert-success alert-dismissible" role="alert">';
		echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
		echo __d('webzash', 'Since this is your first time, you can login with username as "admin" and password as "admin". Please change your password after login.');
		echo '</div>';
	} else if ($default_password) {
		echo '<div class="alert alert-danger alert-dismissible" role="alert">';
		echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
		echo __d('webzash', 'Warning ! Password still not updated for "admin" user. Please change your password after login.');
		echo '</div>';
	}

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
	'class' => 'btn btn-success shadow btn-block'
	));
	echo '</div>';

	echo $this->Form->end();

	
?>
<div class="float-end">
	<?php 
		echo $this->Html->link(__d('webzash', 'Register'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'register'));
		echo ' | ';
		echo $this->Html->link(__d('webzash', 'Forgot Password'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'forgot'));
	?>
</div>
</div>

