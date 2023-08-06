<?php

?>
<style>
	.settings-desc{
		color: white;
	}
 
</style>
<!-- helpeer function html->link -->
<!-- custom css and custom css (1) -->
<div class="row" style="background-color: #224; color: white; padding: 50px 20px; border-radius: 20px;">
	<div class="col-md-4">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Create account'), array('plugin' => 'webzash', 'controller' => 'wzaccounts', 'action' => 'create')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Create a new account '); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Manage accounts'), array('plugin' => 'webzash', 'controller' => 'wzaccounts', 'action' => 'index')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Manage existing accounts '); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Manage users'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'index')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Manage users and permissions'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'General settings'), array('plugin' => 'webzash', 'controller' => 'wzsettings', 'action' => 'edit')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'General application settings'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'System information'), array('plugin' => 'webzash', 'controller' => 'wzsettings', 'action' => 'sysinfo')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'General system information'); ?>
			</div>
		</div>
	</div>
</div>
