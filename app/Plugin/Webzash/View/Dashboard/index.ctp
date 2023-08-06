
<!-- bootstrap.min.css -->
<!-- Configure::read('Account.address') return a object of address function -->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Account details'); ?></div>
			<div class="panel-body">
				<table>
					<tr>
						<td valign="top"><?php echo __d('webzash', 'Name'); ?></td>
						<td>
							<?php echo h(Configure::read('Account.name')); ?><br />
							<?php echo nl2br(h(Configure::read('Account.address'))); ?>
						</td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Email'); ?></td>
						<td><?php echo h(Configure::read('Account.email')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Role'); ?></td>
						<td><?php echo h($this->Session->read('ActiveAccount.account_role')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Currency'); ?></td>
						<td><?php echo h(Configure::read('Account.currency_symbol')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Financial Year'); ?></td>
						<td><?php echo dateFromSql(Configure::read('Account.startdate')) . ' to ' . dateFromSql(Configure::read('Account.enddate')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Status'); ?></td>
						<?php
							if (Configure::read('Account.locked') == 0) {
								echo '<td>' . __d('webzash', 'Unlocked') . '</td>';
							} else {
								echo '<td class="error-text">' . __d('webzash', 'Locked') . '</td>';
							}
						?>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Bank & cash summary'); ?></div>
			<div class="panel-body">
				<table>
				<?php
					foreach ($ledgers as $ledger) {
						echo '<tr>';
						echo '<td>' . $ledger['name'] . '</td>';
						echo '<td>' . toCurrency($ledger['balance']['dc'], $ledger['balance']['amount']) . '</td>';
						echo '</tr>';
					}
				?>
				</table>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Account summary'); ?></div>
			<div class="panel-body">
				<table>
					<tr>
						<td><?php echo __d('webzash', 'Assets'); ?></td>
						<td><?php echo toCurrency($accsummary['assets_total_dc'], $accsummary['assets_total']); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', ' Liabilities and Owners Equity'); ?></td>
						<td><?php echo toCurrency($accsummary['liabilities_total_dc'], $accsummary['liabilities_total']); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Income'); ?></td>
						<td><?php echo toCurrency($accsummary['income_total_dc'], $accsummary['income_total']); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Expense'); ?></td>
						<td><?php echo toCurrency($accsummary['expense_total_dc'], $accsummary['expense_total']); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Recent activity'); ?></div>
			<div class="panel-body">
				<?php
					if (count($logs) <= 0) {
						echo 'Nothing here.';
					} else {
						echo '<table>';
						foreach ($logs as $row => $data) {
							echo '<tr>';
							echo '<td>' . dateFromSql($data['Log']['date']) . '</td>';
							echo '<td>' . h($data['Log']['message']) . '</td>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<span class="pull-right">' . $this->Html->link(__d('webzash', 'more'), array('plugin' => 'webzash', 'controller' => 'logs', 'action' => 'index')) . '</span>';
					}
				?>
			</div>
		</div>
	</div>
</div>
