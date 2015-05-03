<?php namespace ABD\Mailer\Transporters;

use ABD\Mailer\Transporter;

class Gmail extends Transporter {

    protected $host = 'smtp.gmail.com';

    protected $port = [
        'ssl'   => 465,
        'tls'   => 587
    ]; 

}