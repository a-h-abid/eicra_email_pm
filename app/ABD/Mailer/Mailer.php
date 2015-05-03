<?php namespace ABD\Mailer;

class Mailer {

    protected $mailer;

    protected $config;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;

        $this->getConfig();

        $this->bootConfig();
    }

    // =================================================================================

    protected function bootConfig()
    {
        foreach ($this->config as $method => $value)
        {
            if (method_exists($this->mailer, $method))
                $this->mailer->$method( $value );
        }
    }

    public function getConfig()
    {
        if ($this->config == null)
            $this->config = include __DIR__.'/config.php';

        return $this->config;
    }

    public function setConfig($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    public function setConfigs($options)
    {
        foreach ($options as $key => $value)
        {
            $this->setConfig($key, $value);
        }

        return $this;
    }

    // =================================================================================

    public function setDriver($driver)
    {
        $this->mailer->driver($driver);

        return $this;
    }

    public function setHost($host)
    {
        $this->mailer->host($host);

        return $this;
    }

    public function setPort($port)
    {
        $this->mailer->port($port);

        return $this;
    }

    public function setEncription($encription)
    {
        $this->mailer->encription($encription);

        return $this;
    }

    public function setLogin($email, $password)
    {
        $this->mailer->login($email, $password);

        return $this;
    }

    public function setAuthentication($bool = false)
    {
        $this->mailer->authentication($bool);

        return $this;
    }

    public function setDebug($bool = false)
    {
        $this->mailer->debug($bool);

        return $this;
    }

    public function setTransporter($name)
    {
        $transporter = null;

        foreach ($this->config['transporters'] as $className => $aliasCollection)
        {
            if (in_array($name, $aliasCollection))
            {
                $transporter = $className;
                break;
            }
        }

        if ($transporter == null)
            throw new Exception("Transporter for '{$name}' is not found.");

        if (!class_exists($transporter))
            throw new Exception("Class named '{$transporter}' is not found.");

        $transport = new $transporter();
        if (!$transport instanceof Transporter)
            throw new Exception("Class '{$transporter}' is not an instance of ". Transporter::class .".");

        $this->mailer->host( $transport->getHost() );
        $this->mailer->port( $transport->getPort( $this->config['encription'] ) );

        return $this;
    }

    public function getError()
    {
        return $this->mailer->error();
    }

    // =================================================================================

    public function setFromReply($email, $name)
    {
        $this->mailer->fromReply($email, $name);
        
        return $this;
    }

    public function setTo($email, $name)
    {
        $this->mailer->to($email, $name);

        return $this;
    }

    public function setCc($email, $name)
    {
        $this->mailer->cc($email, $name);

        return $this;
    }

    public function setBcc($email, $name)
    {
        $this->mailer->bcc($email, $name);

        return $this;
    }

    public function setAttachment($file_path)
    {
        $this->mailer->attachment($file_path);

        return $this;
    }

    public function setSubject($subject)
    {
        $this->mailer->subject($subject);

        return $this;
    }

    public function setBody($message_html)
    {
        $this->mailer->body($message_html);

        return $this;
    }

    public function setBodyAlternate($message_text)
    {
        $this->mailer->bodyAlternate($message_text);

        return $this;
    }

    public function send()
    {
        return $this->mailer->send();
    }

}