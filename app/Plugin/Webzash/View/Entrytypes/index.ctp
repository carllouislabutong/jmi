<!-- customcss and 1 -->
<table class="stripped">
	<tr>
		<th><?php echo $this->Paginator->sort('label', __d('webzash', 'Label')); ?></th>
		<th><?php echo $this->Paginator->sort('name', __d('webzash', 'Name')); ?></th>
		<th><?php echo $this->Paginator->sort('description', __d('webzash', 'Description')); ?></th>
		<th><?php echo $this->Paginator->sort('prefix', __d('webzash', 'Prefix')); ?></th>
		<th><?php echo $this->Paginator->sort('suffix', __d('webzash', 'Suffix')); ?></th>
		<th><?php echo $this->Paginator->sort('zero_padding', __d('webzash', 'Zero Padding')); ?></th>
		<th><?php echo __d('webzash', 'Actions'); ?></th>
	</tr>
	<?php foreach ($entrytypes as $entrytype) { ?>
		<tr>
			<td><?php echo h($entrytype['Entrytype']['label']); ?></td>
			<td><?php echo h($entrytype['Entrytype']['name']); ?></td>
			<td><?php echo h($entrytype['Entrytype']['description']); ?></td>
			<td><?php echo h($entrytype['Entrytype']['prefix']); ?></td>
			<td><?php echo h($entrytype['Entrytype']['suffix']); ?></td>
			<td><?php echo h($entrytype['Entrytype']['zero_padding']); ?></td>
			<td>
				<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'entrytypes', 'action' => 'edit', $entrytype['Entrytype']['id']), array('class' => 'no-hover', 'escape' => false)); ?>
				<?php echo $this->Html->tag('span', '', array('class' => 'link-pad')); ?>
				<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'entrytypes', 'action' => 'delete', $entrytype['Entrytype']['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the entry type?'))); ?>
			</td>
		</tr>
	<?php } ?>
</table>
<!-- bootsrap.min.css and custom css and 1 -->
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
