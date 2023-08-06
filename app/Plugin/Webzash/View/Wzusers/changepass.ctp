
<div class="wzusers changepass form">
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

		echo $this->Form->input('existing_password', array('type' => 'password', 'label' => __d('webzash', 'Existing password')));
		echo $this->Form->input('new_password', array('type' => 'password', 'label' => __d('webzash', 'New password')));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		if (AuthComponent::user('role') == 'admin') {
			echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'admin', 'action' => 'index'), array('class' => 'btn btn-default'));
		} else {
			echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'index'), array('class' => 'btn btn-default'));
		}
		echo '</div>';

		echo $this->Form->end();

	?>
</div>
