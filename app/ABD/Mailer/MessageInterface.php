<?php namespace ABD\Mailer;

interface MessageInterface {

    public function from($email, $name);

    public function fromReply($email, $name);

    public function replyTo($email, $name);

    public function to($email, $name);

    public function cc($email, $name);

    public function bcc($email, $name);

    public function attachment($file_path);

    public function subject($text);

    public function body($html);
    
    public function bodyAlternate($text);

    public function send();

}