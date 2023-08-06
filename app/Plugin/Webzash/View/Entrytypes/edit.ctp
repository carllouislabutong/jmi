
<div class="entrytypes edit form">
	<?php
		echo $this->Form->create('Entrytype', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		echo $this->Form->input('label', array('label' => __d('webzash', 'Label')));
		echo $this->Form->input('name', array('label' => __d('webzash', 'Name')));
		echo $this->Form->input('description', array('type' => 'textarea', 'label' => __d('webzash', 'Description'), 'rows' => '3'));
		echo $this->Form->input('numbering', array(
			// custom.css and 1
			'type' => 'select',
			'options' => $this->Generic->entrytype_numbering_options(),
			'label' => __d('webzash', 'Numbering'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : How the entry numbering is handled.') . '</span>',
		));
		echo $this->Form->input('prefix', array(
			'label' => __d('webzash', 'Prefix'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Prefix to add before entry numbers.') . '</span>',
		));
		echo $this->Form->input('suffix', array(
			'label' => __d('webzash', 'Suffix'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Suffix to add after entry numbers.') . '</span>',
		));
		echo $this->Form->input('zero_padding', array(
			'label' => __d('webzash', 'Zero Padding'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Number of zeros to pad before entry numbers.') . '</span>',
		));
		echo $this->Form->input('restriction_bankcash', array(
			'type' => 'select',
			'options' => $this->Generic->entrytype_restriction_options(),
			'label' => __d('webzash', 'Restrictions'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Restrictions to be placed on the ledgers selected in entry.') . '</span>',
		));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'entrytypes', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
