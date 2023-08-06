

<?php
	if ($success) {
		echo '<h4>' . $this->Html->link(__d('webzash', 'Click here to Login'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'login')) . '</h4>';
	} else {
		echo '<h4>' . $this->Html->link(__d('webzash', 'Click here to resend verification email'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'resend')) . '</h4>';
	}
?>
