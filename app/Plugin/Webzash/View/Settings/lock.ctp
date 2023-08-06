
<div class="lock form">
<?php
	echo $this->Form->create('Setting', array(
		'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control',
		),
	));

	if ($locked == '1') {
		echo $this->Form->label('Setting.lock', __d('webzash', 'Currently this account is locked'));
	} else {
		echo $this->Form->label('Setting.lock', __d('webzash', 'Currently this account is unlocked'));
	}
	echo $this->Form->input('account_locked', array(
		'type' => 'checkbox',
		'checked' => $locked,
		'label' => __d('webzash', 'Lock account'),
		'class' => 'checkbox',
		'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Once a account is locked no further changes will be permitted. You will have to unlock it to make changes.') . '</span>',
	));

	echo '<div class="form-group">';
	echo $this->Form->submit(__d('webzash', 'Submit'), array(
		'div' => false,
		'class' => 'btn btn-primary'
	));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'index'), array('class' => 'btn btn-default'));
	echo '</div>';

	echo $this->Form->end();
?>
</div>
