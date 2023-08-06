
<style>
    td,i,a,th{
		color: white;
	}
</style>
<table class="stripped">
	<tr>
		<th><?php echo $this->Paginator->sort('username', __d('webzash', 'Username')); ?></th>
		<th><?php echo $this->Paginator->sort('fullname', __d('webzash', 'Fullname')); ?></th>
		<th><?php echo $this->Paginator->sort('email', __d('webzash', 'Email')); ?></th>
		<th><?php echo $this->Paginator->sort('status', __d('webzash', 'Status')); ?></th>
		<th><?php echo $this->Paginator->sort('status', __d('webzash', 'Approved')); ?></th>
		<th><?php echo $this->Paginator->sort('role', __d('webzash', 'Role')); ?></th>
		<th><?php echo __d('webzash', 'Actions'); ?></th>
	</tr>
	<?php foreach ($wzusers as $wzuser) { ?>
		<tr>
			<td><?php echo h($wzuser['Wzuser']['username']); ?></td>
			<td><?php echo h($wzuser['Wzuser']['fullname']); ?></td>
			<td><?php echo h($wzuser['Wzuser']['email']); ?></td>
			<td><?php echo h($this->Generic->wzuser_status($wzuser['Wzuser']['status'])); ?></td>
			<td>
				<?php if ($wzuser['Wzuser']['admin_verified'] == 1) {
					echo __d('webzash', 'Yes');
				} else {
					echo __d('webzash', 'No');
				}
				?>
			</td>
			<td><?php echo h($this->Generic->wzuser_role($wzuser['Wzuser']['role'])); ?></td>
			<td>
				<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'edit', $wzuser['Wzuser']['id']), array('class' => 'no-hover', 'escape' => false)); ?>
				<?php echo $this->Html->tag('span', '', array('class' => 'link-pad')); ?>
				<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-off')) . __d('webzash', ' Password'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'resetpass', 'userid' => $wzuser['Wzuser']['id']), array('class' => 'no-hover', 'escape' => false)); ?>
				<?php echo $this->Html->tag('span', '', array('class' => 'link-pad')); ?>
				<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'delete', $wzuser['Wzuser']['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the user ?'))); ?>
			</td>
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
