<?php namespace ABD\Mailer\Mailers;

use ABD\Mailer\MailerInterface;
use PHPmailer;

class PHPmailerSystem implements MailerInterface {

    protected $mailer;

    protected $configMapper = [
        'driver'            => 'Mailer',
        'encription'        => 'tls',
        'authentication'    => true,
    ];

    public function __construct(PHPmailer $mailer)
    {
        $this->mailer = $mailer;
    }

    // =======================================================================================
    
    protected function setupConfiguration($config)
    {
        $mailerReflector = new ReflectionClass(get_class($this->mailer));

        $properties = $mailerReflector->getProperties(ReflectionProperty::IS_PUBLIC);
        $methods = $mailerReflector->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($config as $key => $value)
        {
            if (in_array($key, $methods))
            {
                $this->callMailerMethod($key, $value);
            }
            elseif (in_array($key, $properties))
            {
                $this->mailer->$key = $value;
            }
        }
    }

    // =======================================================================================

    public function driver($driver)
    {
        if (strtolower($driver) == 'smtp')
            $driver = 'SMTP';

        $method = 'is'.ucfirst($driver);

        if (! method_exists($this->mailer, $method))
            throw new Exception("Driver '{$driver}' is not found in PHPmailer.");
            
        $this->mailer->$method();
    }

    public function host($host)
    {
        $this->mailer->Host = $host;
    }

    public function port($port)
    {
        $this->mailer->Port = $port;
    }

    public function login($email, $password)
    {
        $this->mailer->Username = $email;
        $this->mailer->Password = $password;
    }

    public function authentication($bool = true)
    {
        $this->mailer->SMTPAuth = $bool;
    }

    public function encription($type)
    {
        $this->mailer->SMTPSecure = $type;
    }

    /**
     * Enable SMTP debugging
     * 0 = off (for production use)
     * 1 = client messages
     * 2 = client and server messages
     *
     * @param boolean $bool
     */
    public function debug($bool = false)
    {
        $this->mailer->SMTPDebug = $bool ? 2 : 0;
        $this->mailer->Debugoutput = 'html';
    }

    // =======================================================================================

    public function from($email, $name)
    {
        $this->mailer->setFrom($email, $name);
    }

    public function fromReply($email, $name)
    {
        $this->from($email, $name);

        $this->replyTo($email, $name);
    }

    public function replyTo($email, $name)
    {
        $this->mailer->addReplyTo($email, $name);
    }

    public function to($email, $name)
    {
        $this->mailer->addAddress($email, $name);
    }

    public function cc($email, $name)
    {
        $this->mailer->addCC($email, $name);
    }

    public function bcc($email, $name)
    {
        $this->mailer->addBCC($email, $name);
    }

    public function attachment($file_path)
    {
        $this->mailer->addAttachment($file_path);
    }

    public function subject($text)
    {
        $this->mailer->Subject = $text;
    }

    public function body($html)
    {
        $this->mailer->msgHTML($html);
    }
    
    public function bodyAlternate($text)
    {
        $this->mailer->AltBody = $text;
    }

    public function send()
    {
        return $this->mailer->send();
    }

    // ==========================================================================
    
    public function __call($method, $arguments)
    {
        $this->callMailerMethod($method, $arguments);
    }

    private function callMailerMethod($method, $params)
    {
        if (!is_array($params))
            $params = [$params];

        return call_user_func_array([$this->mailer, $method], $params);
    }

}