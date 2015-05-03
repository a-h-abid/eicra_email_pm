<?php namespace ABD\Mailer\Transporters;

use ABD\Mailer\Transporter;

class Live extends Transporter {

    protected $host = 'smtp.live.com';

    protected $port = [
        'ssl'   => 465,
        'tls'   => 587
    ]; 

}