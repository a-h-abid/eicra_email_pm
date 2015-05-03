<?php namespace ABD\Mailer\Mailers\PHPmailer;

use Slim\Slim;

class PHPmailerServiceProvider {

    protected $slim;

    public function __construct($slim)
    {
        $this->slim = $slim;

        $this->setDependencyContainer();
    }

    protected function setDependencyContainer()
    {
        $this->slim->container->singleton('abd.mailer',function(){
            return new PHPmailerSystem(new \PHPMailer);
        });
    }

}
