
<div class="printer form">
	<?php
		$prefixInches = '<div class="input-group">';
		$suffixInches = '<span class="input-group-addon">' . __d('webzash', 'inches') .'</span></div>';

		echo $this->Form->create('Setting', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));
	?>
	<fieldset>
		<legend><?php echo __d('webzash', 'Paper Size'); ?></legend>
		<?php echo $this->Form->input('print_paper_height', array('label' => __d('webzash', 'Height'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
		<?php echo $this->Form->input('print_paper_width', array('label' => __d('webzash', 'Width'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
	</fieldset>
	<fieldset>
		<legend><?php echo __d('webzash', 'Paper Margin'); ?></legend>
		<?php echo $this->Form->input('print_margin_top', array('label' => __d('webzash', 'Top'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
		<?php echo $this->Form->input('print_margin_bottom', array('label' => __d('webzash', 'Bottom'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
		<?php echo $this->Form->input('print_margin_left', array('label' => __d('webzash', 'Left'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
		<?php echo $this->Form->input('print_margin_right', array('label' => __d('webzash', 'Right'), 'beforeInput' => $prefixInches, 'afterInput' => $suffixInches)); ?>
	</fieldset>
	<fieldset>
		<legend><?php echo __d('webzash', 'Orientation'); ?></legend>
		<?php echo $this->Form->input('print_orientation', array('type' => 'radio', 'options' => $this->Generic->printer_orientation_options(), 'legend' => false, 'class' => 'radio')); ?>
	</fieldset>
	<fieldset>
		<legend><?php echo __d('webzash', 'Output Format'); ?></legend>
		<?php echo $this->Form->input('print_page_format', array('type' => 'radio', 'options' => $this->Generic->printer_pageformat_options(), 'legend' => false, 'class' => 'radio')); ?>
	</fieldset>
	<br />
	<?php
		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'settings', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
