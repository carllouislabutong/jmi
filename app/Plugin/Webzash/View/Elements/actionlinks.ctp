<?php


/* Show the action links button */
// custom css cusotm css(1)
if (isset($actionlinks)) {
	echo '<div id="actionlinks">';
	echo '<ul>';
	foreach ($actionlinks as $key => $item) {
		if (!isset($item['data'])) {
			echo '<li>' . $this->Html->link($item['title'], array('plugin' => 'webzash', 'controller' => $item['controller'], 'action' => $item['action']), array('class' => 'btn btn-primary')) . '</li>';
		} else {
			echo '<li>' . $this->Html->link($item['title'], array('plugin' => 'webzash', 'controller' => $item['controller'], 'action' => $item['action'], $item['data']), array('class' => 'btn btn-primary')) . '</li>';
		}
	}
	echo '</ul>';
	echo '</div>';
}

