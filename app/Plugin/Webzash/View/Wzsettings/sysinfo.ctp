
<style>
	 
	div{
		color: white;
	}
</style>
<div>
	<?php echo __d('webzash', 'Application version : %s', Configure::read('Webzash.AppVersion')); ?>
</div>
<div>
	<?php echo __d('webzash', 'Application database version : %s', Configure::read('Webzash.AppDatabaseVersion')) ; ?>
</div>
<div>
	<?php echo __d('webzash', 'PHP version : %s', phpversion()) ; ?>
</div>
<div>
	<?php
		if (extension_loaded('bcmath')) {
			echo __d('webzash', 'PHP BC Math library : Yes');
		} else {
			echo '<span class="error-text">';
			echo __d('webzash', 'PHP BC Math library : No');
			echo '</span>';
		}
	?>
</div>
<div>
	<?php
		if (method_exists('SQLite3', 'version')) {
			echo __d('webzash', 'PHP Sqlite3 library : %s', SQLite3::version());
		}
	?>
</div>
<div>
	<?php
		echo __d('webzash', 'CakePHP version : %s', Configure::version());
	?>
</div>
