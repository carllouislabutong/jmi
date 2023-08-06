
<div class="row">
	<div class="col-md-4">
		<div class="reports-container">
			<div class="reports-title">
				<?php echo $this->Html->link(__d('webzash', 'Balance sheet'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'balancesheet')); ?>
			</div>
			<div class="reports-desc">
			</div>
		</div>
		<div class="reports-container">
			<div class="reports-title">
				<?php echo $this->Html->link(__d('webzash', 'Profit and Loss statement'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'profitloss')); ?>
			</div>
			<div class="reports-desc">
			</div>
		</div>
		<div class="reports-container">
			<div class="reports-title">
				<?php echo $this->Html->link(__d('webzash', 'Trial balance'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'trialbalance')); ?>
			</div>
			<div class="reports-desc">
			</div>
		</div>
		<div class="reports-container">
			<div class="reports-title">
				<?php echo $this->Html->link(__d('webzash', 'Ledger statement'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'ledgerstatement')); ?>
			</div>
			<div class="reports-desc">
			</div>
		</div>
		<div class="reports-container">
			<div class="reports-title">
				<?php echo $this->Html->link(__d('webzash', 'Reconciliation'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'reconciliation')); ?>
			</div>
			<div class="reports-desc">
			</div>
		</div>
	</div>
</div>
