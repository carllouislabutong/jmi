<!-- customcss -->
<div class="alert alert-danger" role="alert">
	<?php echo __d('webzash', 'Failed to send email. Please check your email settings.'); ?>
</div>
<?php CakeSession::delete('emailError'); ?>
