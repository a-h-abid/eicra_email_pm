<?php

// Home Page
$app->get('/', function() use ($app) {
    
    $app->render('home/home.php');

})->name('home');

// Jira Test
$app->get('/jira-test', function() use ($app){
    
    try
    {
        $jira = $app->container->get('eicra.jira');
        $jira->login(APP_EICRA_JIRA_USERNAME, APP_EICRA_JIRA_PASSWORD);

        $jira_repo = new Eicra\Jira\IssuesRepository($jira);
        $issues = $jira_repo->getMyOpenIssues();

        $data = [
            'issues' => $issues,
        ];
    }
    catch(Exception $e)
    {
        $data = [
            'errors' => $e->getMessage(),
        ];
    }

    $app->render('jira/jira-issues.php', $data);

})->name('jira');

// POST Submit Email
$app->post('/send', function() use ($app) {

    $email_config = require_once('config/email.php');
    $email_settings = $email_config['platform'][$_POST['mailing_system']];

    $html_output_parser = array(
        '{{subject}}'           => $_POST['subject'],
        '{{header_message}}'    => nl2br($_POST['header_message']),
        '{{message_lines}}'     => '<li>' . implode('</li><li>',$_POST['message_lines']) . '</li>',
        '{{signature}}'         => nl2br($_POST['signature']),
    );

    $html_output = file_get_contents('views/email/template.html.php');
    $html_output = str_replace(array_keys($html_output_parser), array_values($html_output_parser), $html_output);

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = isDebugMode() ? 2 : 0;
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = $email_settings['host'];
    $mail->Port = $email_settings['port_tls'];
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $_POST['user_email'];
    $mail->Password = $_POST['user_password'];

    //Set who the message is to be sent from
    $mail->setFrom($_POST['send_from_email'], $_POST['send_from_name']);
    $mail->addReplyTo($_POST['send_from_email'], $_POST['send_from_name']);

    //Set who the message is to be sent to
    $mail->addAddress($_POST['send_to_email'], $_POST['send_to_name']);

    $mail->Subject = $_POST['subject'];

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($html_output);

    try
    {
        $status_msg = (!$mail->send())
                        ? "Mailer Error: " . $mail->ErrorInfo
                        : "Message sent!";
    }
    catch(phpmailerException $e)
    {
        $status_msg = "Exception: ". $e->getMessage();
    }
    catch(Exception $e)
    {   
        $status_msg = "Exception: ". $e->getMessage();
    }

    $app->flash('alert', $status_msg);

    $app->redirectTo('home');

})->name('send-email');
