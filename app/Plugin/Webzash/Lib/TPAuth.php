<?php


App::uses('JoomlaAuth', 'Webzash.Lib');
App::uses('JoomlaAutoAuth', 'Webzash.Lib');

class TPAuth {

        public function __construct($authlib) {
                $className = $authlib . 'Auth';
                $this->auth = new $className;
        }

        public function checkPassword($username, $password) {
                return $this->auth->checkPassword($username, $password);
        }

        public function getUserDetails() {
                return $this->auth->getUserDetails();
        }

        public function siteURL() {
                return $this->auth->site_url;
        }

        public function loginURL() {
                return $this->auth->login_url;
        }

        public function logoutURL() {
                return $this->auth->logout_url;
        }

        public function default_email() {
                return $this->auth->default_email;
        }

        public function admin_username() {
                return $this->auth->admin_username;
        }
}
