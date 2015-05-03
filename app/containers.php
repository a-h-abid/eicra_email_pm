<?php

// Set Eicra Jira DI
(new Eicra\Jira\JiraServiceProvider($app));

// Set ABD Mail Service Provider
(new ABD\Mailer\Mailers\PHPmailer\PHPmailerServiceProvider($app));

