<!-- customcss and 1 -->
<div class="row">
	<div class="col-md-4">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Account settings'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'account')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Setup account details, currency, time, etc.'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Carry forward'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'cf')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Carry forward account to next financial year'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Email settings'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'email')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Setup outgoing email'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Printer settings'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'printer')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Setup printing options for entries, reports, etc.'); ?>
			</div>
		</div>
		<!-- <div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Download backup'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'backup')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Download backup of current accounts data'); ?>
			</div>
		</div> -->
	</div>
	<div class="col-md-4">
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Tags'), array('plugin' => 'webzash', 'controller' => 'tags', 'action' => 'index')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Manage tags'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Entry Types'), array('plugin' => 'webzash', 'controller' => 'entrytypes', 'action' => 'index')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Manage entry types'); ?>
			</div>
		</div>
		<div class="settings-container">
			<div class="settings-title">
				<?php echo $this->Html->link(__d('webzash', 'Lock account'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'lock')); ?>
			</div>
			<div class="settings-desc">
				<?php echo __d('webzash', 'Lock account to prevent further changes'); ?>
			</div>
		</div>
	</div>
</div>
