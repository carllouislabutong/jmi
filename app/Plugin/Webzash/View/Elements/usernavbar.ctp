<!-- bottsrap -->
<!-- Static navbar -->
<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link(
				Configure::read('Webzash.AppName'),
				Configure::read('Webzash.AppURL'),
				array('class' => 'navbar-brand', 'target' => '_blank')
			); ?>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo $this->Html->link(__d('webzash', 'Register'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'register')); ?></li>
				<li><?php echo $this->Html->link(__d('webzash', 'Login'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'login')); ?></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>
