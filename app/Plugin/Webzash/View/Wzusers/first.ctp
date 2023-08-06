
<div class="wzusers first form">
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

		echo $this->Form->input('password', array('label' => __d('webzash', 'New Password')));
		echo $this->Form->input('fullname', array('label' => __d('webzash', 'Fullname')));
		echo $this->Form->input('email', array('type' => 'email', 'label' => __d('webzash', 'Email')));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary btn-block'
		));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
