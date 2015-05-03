<?php namespace ABD\Mailer;

interface MailerInterface extends MailConfigurationInterface, MessageInterface {

    public function error();

}