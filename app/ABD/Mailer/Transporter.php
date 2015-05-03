<?php namespace ABD\Mailer;

abstract class Transporter {

    protected $host;
    
    protected $port;

    public function getHost()
    {
        return $this->host;
    }

    public function getPort($type)
    {
        return $this->port[$type];
    }

}