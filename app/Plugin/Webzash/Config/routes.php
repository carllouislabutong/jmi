<?php


Router::connect('/:controller/:action/*', array('plugin' => 'webzash'));
Router::connect('/:controller/*', array('plugin' => 'webzash', 'action' => 'index'));
Router::connect('/*', array('plugin' => 'webzash', 'controller' => 'dashboard', 'action' => 'index'));
