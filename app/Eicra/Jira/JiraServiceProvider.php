<?php namespace Eicra\Jira;

use Slim\Slim;

class JiraServiceProvider {

    protected $slim;

    protected $host = 'http://eicrasoft.atlassian.net';

    public function __construct($slim)
    {
        $this->slim = $slim;

        $this->setDependencyContainer();
    }

    protected function setDependencyContainer()
    {
        $this->slim->container->singleton('eicra.jira',function(){
            return new \Jira\JiraClient($this->host);
        });
    }

}
