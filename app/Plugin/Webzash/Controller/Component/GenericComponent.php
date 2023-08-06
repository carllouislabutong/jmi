<?php


App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Webzash Plugin Generic Component
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class GenericComponent extends Component {

	public $components = array('Session');

/**
 * Send email
 */
	public function sendEmail($to = '', $subject = '', $view = '', $viewVars = array(),
		$useDefault = true, $errorInSesson = false) {
		if ($useDefault == true) {
			App::import("Webzash.Model", "Wzsetting");
			$this->Wzsetting = new Wzsetting();
			$this->Wzsetting->useDbConfig = 'wz';

			$wzsetting = $this->Wzsetting->findById(1);

			if (!$wzsetting) {
				if ($errorInSesson) {
					$this->Session->write('emailError', true);
				}
				return false;
			}

			$viewVars['sitename'] = $wzsetting['Wzsetting']['sitename'];

			$config = array(
				'host' => $wzsetting['Wzsetting']['email_host'],
				'port' => $wzsetting['Wzsetting']['email_port'],
				'username' => $wzsetting['Wzsetting']['email_username'],
				'password' => $wzsetting['Wzsetting']['email_password'],
				'transport' => $wzsetting['Wzsetting']['email_protocol'],
			);
			if ($wzsetting['Wzsetting']['email_tls'] == '1') {
				$config['tls'] = true;
			} else {
				$config['tls'] = false;
			}

			$Email = new CakeEmail();
			$Email->config($config);
			try {
				$Email->from(array($wzsetting['Wzsetting']['email_username'] =>
						$wzsetting['Wzsetting']['email_from']))
					->template('Webzash.' . $view, 'Webzash.email')
					->viewVars($viewVars)
					->emailFormat('both')
					->to($to)
					->subject($subject)
					->send();
			} catch (Exception $e) {
				if ($errorInSesson) {
					$this->Session->write('emailError', true);
				}
				return false;
			}

		} else {
			App::import("Webzash.Model", "Setting");
			$this->Setting = new Setting();

			$setting = $this->Setting->findById(1);

			if (!$setting) {
				if ($errorInSesson) {
					$this->Session->write('emailError', true);
				}
				return false;
			}

			/* TODO : $viewVars['sitename'] = $wzsetting['Wzsetting']['sitename']; */
			$viewVars['name'] = $setting['Setting']['name'];
			$viewVars['address'] = $setting['Setting']['address'];
			$viewVars['email'] = $setting['Setting']['email'];
			$viewVars['currency_symbol'] = $setting['Setting']['currency_symbol'];
			$viewVars['date_format'] = $setting['Setting']['date_format'];

			$config = array(
				'host' => $setting['Setting']['email_host'],
				'port' => $setting['Setting']['email_port'],
				'username' => $setting['Setting']['email_username'],
				'password' => $setting['Setting']['email_password'],
				'transport' => $setting['Setting']['email_protocol'],
			);
			if ($setting['Setting']['email_tls'] == '1') {
				$config['tls'] = true;
			} else {
				$config['tls'] = false;
			}

			$Email = new CakeEmail();
			$Email->config($config);
			try {
				$Email->from(array($setting['Setting']['email_username'] =>
						$setting['Setting']['email_from']))
					->template('Webzash.' . $view, 'Webzash.email')
					->viewVars($viewVars)
					->emailFormat('both')
					->to($to)
					->subject($subject)
					->send();
			} catch (Exception $e) {
				if ($errorInSesson) {
					$this->Session->write('emailError', true);
				}
				return false;
			}
		}

		return true;
	}
}
