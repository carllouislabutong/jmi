
<table class="stripped">
	<tr>
		<th><?php echo $this->Paginator->sort('date', __d('webzash', 'Date')); ?></th>
		<th><?php echo $this->Paginator->sort('host_ip', __d('webzash', 'Host IP')); ?></th>
		<th><?php echo $this->Paginator->sort('user', __d('webzash', 'Username')); ?></th>
		<th><?php echo $this->Paginator->sort('url', __d('webzash', 'URL')); ?></th>
		<th><?php echo $this->Paginator->sort('message', __d('webzash', 'Message')); ?></th>
	</tr>
	<?php foreach ($logs as $log) { ?>
		<tr>
			<td><?php echo datetimeFromSqlDateTime($log['Log']['date']); ?></td>
			<td><?php echo h($log['Log']['host_ip']); ?></td>
			<td><?php echo h($log['Log']['user']); ?></td>
			<td><?php echo h($log['Log']['url']); ?></td>
			<td><?php echo h($log['Log']['message']); ?></td>
		</tr>
	<?php } ?>
</table>

<div class="text-center paginate">
	<ul class="pagination">
		<?php
			echo $this->Paginator->first(__d('webzash', 'first'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->prev(__d('webzash', 'prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
			echo $this->Paginator->next(__d('webzash', 'next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->last(__d('webzash', 'last'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	</ul>
</div>
