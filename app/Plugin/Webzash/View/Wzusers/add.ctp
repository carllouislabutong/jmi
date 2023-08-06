
<div class="wzuser add form">
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
		echo $this->Form->input('fullname', array('label' => __d('webzash', 'Fullname')));
		echo $this->Form->input('email', array('type' => 'email', 'label' => __d('webzash', 'Email')));
		echo $this->Form->input('status', array('type' => 'select', 'options' => $this->Generic->wzuser_status_options(), 'label' => __d('webzash', 'Status')));
		echo $this->Form->input('email_verified', array('type' => 'checkbox', 'label' => __d('webzash', 'Email verified'), 'class' => 'checkbox'));
		echo $this->Form->input('admin_verified', array('type' => 'checkbox', 'label' => __d('webzash', 'Administrator approved'), 'class' => 'checkbox'));
		echo $this->Form->input('role', array('type' => 'select', 'options' => $this->Generic->wzuser_role_options(), 'label' => __d('webzash', 'Role')));

		/* Accounts selection */
		echo $this->Form->input('wzaccount_ids', array(
			'type' => 'select',
			'options' => $wzaccounts,
			'label' => __d('webzash', 'Account access'),
			'multiple' => 'checkbox',
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Select which accounts a user can access. Selecting "ALL ACCOUNTS" will grant them access to all accounts.') . '</span>',
		));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
