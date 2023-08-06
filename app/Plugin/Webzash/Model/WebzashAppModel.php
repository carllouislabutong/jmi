<?php


App::uses('AppModel', 'Model');

/**
 * Webzash App Model
 *
 * @package Webzash
 * @subpackage Webzash.models
 */
class WebzashAppModel extends AppModel {

	function __construct($id = false, $table = null, $ds = null) {

		/* Read the URL to get the controller name */
		$url_params = Router::getParams();
		if (empty($url_params)) {
			parent::__construct($id, $table, $ds);
			return;
		}

		/* Activate account database based on the controller name. If admin section use the 'wz' master database */
		if ($url_params['controller'] == 'admin' || $url_params['controller'] == 'wzusers' ||
			$url_params['controller'] == 'wzaccounts' || $url_params['controller'] == 'wzsettings') {
			$this->useDbConfig = 'wz';
		} else {
			$this->useDbConfig = 'wz_accconfig';
		}

		parent::__construct($id, $table, $ds);
		return;
	}

}
