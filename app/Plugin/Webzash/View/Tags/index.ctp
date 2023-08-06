
<table class="stripped">
	<tr>
		<th><?php echo $this->Paginator->sort('title', __d('webzash', 'Title')); ?></th>
		<th><?php echo __d('webzash', 'Tag'); ?></th>
		<th><?php echo __d('webzash', 'Actions'); ?></th>
	</tr>
	<?php foreach ($tags as $tag) { ?>
		<tr>
			<td><?php echo h($tag['Tag']['title']); ?></td>
			<td><?php echo $this->Generic->showTag($tag['Tag']['id']); ?></td>
			<td>
				<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'tags', 'action' => 'edit', $tag['Tag']['id']), array('class' => 'no-hover', 'escape' => false)); ?>
				<?php echo $this->Html->tag('span', '', array('class' => 'link-pad')); ?>
				<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'tags', 'action' => 'delete', $tag['Tag']['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the tag ?'))); ?>
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
