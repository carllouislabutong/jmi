<!-- bootstrap.min.js -->
<!-- Static navbar -->
<div class="navbar navbar-inverse" role="navigation">
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
			<?php if ($this->Session->read('Auth.User') && $this->Session->read('Auth.User.role') == 'admin'): ?>
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link(__d('webzash', 'Administrator Dashboard'), array('plugin' => 'webzash', 'controller' => 'admin', 'action' => 'index')); ?></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><span><?php echo $this->Html->link(__d('webzash', 'Accounts'), array('plugin' => 'webzash', 'controller' => 'dashboard', 'action' => 'index'), array('class' => 'btn btn-danger navbar-btn')); ?></span> &nbsp; &nbsp;</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__d('webzash', 'Update Profile'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'profile')); ?></li>
						<li><?php echo $this->Html->link(__d('webzash', 'Change Password'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'changepass')); ?></li>
						<li><?php echo $this->Html->link(__d('webzash', 'Logout'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'logout')); ?></li>
					</ul>
				</li>
			</ul>
			<?php endif; ?>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>
