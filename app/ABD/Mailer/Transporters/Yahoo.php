<?php namespace ABD\Mailer\Transporters;

use ABD\Mailer\Transporter;

class Yahoo extends Transporter {

    protected $host = 'smtp.yahoo.com';

    protected $port = [
        'ssl'   => 465,
        'tls'   => 587
    ]; 

}