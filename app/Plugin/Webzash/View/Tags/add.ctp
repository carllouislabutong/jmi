
<?php echo $this->Html->script('Webzash.tinycolor-0.9.15.min'); ?>
<?php echo $this->Html->script('Webzash.pick-a-color-1.2.3.min'); ?>
<?php echo $this->Html->css('Webzash.pick-a-color-1.2.3.min'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(".pick-a-color").pickAColor();
	});
</script>

<div class="tags add form">
	<?php
		echo $this->Form->create('Tag', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->input('title', array('label' => __d('webzash', 'Title')));
		echo $this->Form->input('color', array('class' => 'pick-a-color', 'label' => __d('webzash', 'Color')));
		echo $this->Form->input('background', array('class' => 'pick-a-color', 'label' => __d('webzash', 'Background')));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'tags', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
