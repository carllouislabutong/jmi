
<div class="wzuser add form" style="background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;">
	<?php
		if ($registration) {
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
			echo $this->Form->input('fullname', array('label' => __d('webzash', 'Fullname')));
			echo $this->Form->input('email', array('type' => 'email', 'label' => __d('webzash', 'Email')));

			echo '<div class="form-group">';
			echo $this->Form->submit(__d('webzash', 'Register'), array(
				'div' => false,
				'class' => 'btn btn-primary btn-block',
				'style' => 'margin-bottom: 30px'
			));
			echo $this->Html->tag('span', '', array('class' => 'link-pad'));
			echo $this->Html->link(__d('webzash', 'Login'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'login'), array('class' => 'btn btn-default btn-block'));
			echo '</div>';

			echo $this->Form->end();
		} else {
			echo '<div class="alert alert-danger">' . __d('webzash', 'Sorry, user registration is disabled at this time, try login') . '</div>';

			echo '<div class="form-group">';
			echo $this->Html->link(__d('webzash', 'Login now'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'login'), array('class' => 'btn btn-primary btn-block'));
			echo '</div>';
		}
	?>
</div>
