
<div class="wzusers profile form">
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

		echo $this->Form->input('fullname', array('label' => __d('webzash', 'Fullname')));
		echo $this->Form->input('email', array('label' => __d('webzash', 'Email')));

		echo $this->Form->input('default_account', array(
			'type' => 'select',
			'options' => $wzaccounts,
			'label' => __d('webzash', 'Default active account'),
			'multiple' => false,
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Please select (NONE) if you do not wish to set a default account.') . '</span>'
		));

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
