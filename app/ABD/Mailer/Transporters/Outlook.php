<?php namespace ABD\Mailer\Transporters;

use ABD\Mailer\Transporter;

class Outlook extends Transporter {

    protected $host = 'smtp-mail.outlook.com';

    protected $port = [
        'ssl'   => 465,
        'tls'   => 587
    ]; 

}