<?php namespace ABD\Mailer;

trait TemplateMail {

    abstract public function getTemplate();

    abstract public function getTemplateData($data); 

    public function getTemplateBody($data)
    {
        $html_output_parser = $this->getTemplateData($data);

        return str_replace(array_keys($html_output_parser), array_values($html_output_parser), $this->getTemplate());
    }

    public function setTemplateBody($data)
    {
        $this->setBody( $this->getTemplateBody($data) );

        return $this;
    }

}