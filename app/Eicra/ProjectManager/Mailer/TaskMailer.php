<?php namespace Eicra\ProjectManager\Mailer;

use ABD\Mailer\Mailer;
use ABD\Mailer\TemplateMail;

class TaskMailer extend Mailer {

    use TemplateMail;

    protected $template_file = 'template/task-mailer.php';

    public function getTemplate()
    {
        return file_get_contents($this->template_file);
    }

    public function getTemplateData($data)
    {
        return array(
            '{{subject}}'           => $data['subject'],
            '{{header_message}}'    => nl2br($data['header_message']),
            '{{message_lines}}'     => '<li>' . implode('</li><li>',$data['message_lines']) . '</li>',
            '{{signature}}'         => nl2br($data['signature']),
        );
    }

}