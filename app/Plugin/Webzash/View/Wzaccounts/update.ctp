
<div class="wzaccount update form">
	<?php
		echo $this->Form->create('Wzaccount', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->label('account', __d('webzash', 'Account name : %s', $settings['Setting']['name']));

		echo '<br />';

		echo $this->Form->label('update', __d('webzash', 'Click the "Udpate" button below to update the database.'));

		echo '<br />';

		echo $this->Form->label('update', __d('webzash', 'Please do keep a backup of the account database incase the update process fails.'));

		echo '<br />';
		echo '<br />';

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Update'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'account'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
