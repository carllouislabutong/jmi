
<script type="text/javascript">
$(document).ready(function() {
	$("#WzaccountDbDatasource").change(function() {
		if ($(this).val() == "Database/Postgres") {
			$("#WzaccountDbSchema").parent().show();
		} else {
			$("#WzaccountDbSchema").parent().hide();
			$("#WzaccountDbSchema").val("");
		}
	});
	$('#WzaccountDbDatasource').trigger('change');
});
</script>

<?php
	echo '<div><div role="alert" class="alert alert-warning">' .
		__d('webzash', 'Please use this to add an already existing database configuration to the system.') .
		'</div></div>';
?>

<div class="wzaccount add form">
	<?php
		echo $this->Form->create('Wzaccount', array(
			'style' => 'background-color: #224;padding: 30px; border-radius: 10px; color: white; padding: 40px;',
		'class' => 'container',
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));
// custom css and 1
		echo $this->Form->input('label', array(
			'label' => __d('webzash', 'Label'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : It is recommended to use a descriptive label like "sample20142105" which includes both a short name and the accounting year.') . '</span>',
		));
		echo $this->Form->input('db_datasource', array('type' => 'select', 'options' => $this->Generic->wzaccount_dbtype_options(), 'label' => __d('webzash', 'Database type')));
		echo $this->Form->input('db_database', array('label' => __d('webzash', 'Database name')));
		echo $this->Form->input('db_schema', array(
			'label' => __d('webzash', 'Database schema'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Database schema is required for Postgres database connection. Leave it blank for MySQL connections.') . '</span>',
		));
		echo $this->Form->input('db_host', array('label' => __d('webzash', 'Database host')));
		echo $this->Form->input('db_port', array('label' => __d('webzash', 'Database port')));
		echo $this->Form->input('db_login', array('label' => __d('webzash', 'Database login')));
		echo $this->Form->input('db_password', array('type' => 'password', 'label' => __d('webzash', 'Database password')));
		echo $this->Form->input('db_prefix', array(
			'label' => __d('webzash', 'Database table prefix'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Database table prefix to use (optional). All tables for this account will be created with this prefix, useful if you have only one database available and want to use multiple accounts.') . '</span>',
		));
		echo $this->Form->input('db_persistent', array('type' => 'checkbox', 'label' => __d('webzash', 'Use persistent connection'), 'class' => 'checkbox'));
		echo $this->Form->input('db_settings', array(
			'label' => __d('webzash', 'Database settings'),
			'afterInput' => '<span class="help-block">' . __d('webzash', 'Note : Any additional settings to pass on to the database connection.') . '</span>',
		));

		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'webzash', 'controller' => 'wzaccounts', 'action' => 'index'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
