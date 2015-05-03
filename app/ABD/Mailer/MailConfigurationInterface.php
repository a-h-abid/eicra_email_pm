<?php namespace ABD\Mailer;

interface MailConfigurationInterface {

    public function driver($driver);

    public function host($host);

    public function port($port);
    
    public function login($email, $password);

    public function authentication($bool);

    public function encription($type);

    public function debug($bool);

}