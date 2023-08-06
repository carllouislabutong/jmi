<?php


App::uses('WebzashAppModel', 'Webzash.Model');

/**
 * Webzash Plugin Log Model
 *
 * @package Webzash
 * @subpackage Webzash.Model
 */
class Log extends WebzashAppModel {

	public $validationDomain = 'webzash';

        /* Validation rules for the Log table */
        public $validate = array(
                'level' => array(
                        'rule1' => array(
                                'rule' => 'notBlank',
                                'message' => 'Level cannot be empty',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                        'rule2' => array(
                                /* 1 = success, 2 = notice & 3 = failure */
                                'rule' => array('inList', array(1, 2, 3)),
                                'message' => 'Invalid value for level',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'date' => array(
                        'rule1' => array(
                                'rule' => 'notBlank',
                                'message' => 'Date cannot be empty',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'host_ip' => array(
                        'rule1' => array(
                                'rule' => array('ip', 'both'),
                                'message' => 'Invalid IP address',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'user' => array(
                        'rule1' => array(
                                'rule' => array('maxLength', 100),
                                'message' => 'Username cannot be more than 100 characters',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'url' => array(
                        'rule1' => array(
                                'rule' => 'url',
                                'message' => 'Invalid URL',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'user_agent' => array(
                        'rule1' => array(
                                'rule' => array('maxLength', 255),
                                'message' => 'User agent cannot be more than 100 characters',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
                'message' => array(
                        'rule1' => array(
                                'rule' => array('maxLength', 255),
                                'message' => 'Message cannot be more than 255 characters',
                                'required' => true,
                                'allowEmpty' => false,
                        ),
                ),
        );

        /* Add a Log entry */
        public function add($message, $level) {
                if (CakeSession::read('Wzsetting.enable_logging') != 1) {
                        return true;
                }
                $now = new DateTime();
                $logentry = array('Log' => array(
                        'level' => $level,
                        'date' => $now->format('Y-m-d H:i:s'),
                        'host_ip' => $_SERVER['REMOTE_ADDR'],
                        'user' => CakeSession::read('Auth.User.username'),
                        'url' => Router::url(null, TRUE),
                        'user_agent' => substr(env('HTTP_USER_AGENT'), 0 , 100),
                        'message' => substr($message, 0, 255),
                ));
                $this->create();
                if (!$this->save($logentry)) {
                        return false;
                }
                return true;
        }
}
