<?php

// Home Page
$app->get('/', function() use ($app) {
    
    $app->render('home/home.php');

})->name('home');

// Mail Compose Page
$app->get('/mail', function() use ($app) {
    
    $app->render('mail/mail.php');

})->name('mail');

// POST Submit Email
$app->post('/send', function() use ($app) {

    $mailer = new Eicra\ProjectManager\Mailer\TaskMailer(new PHPMailer);

    try
    {
        $mailer->setTransport($_POST['mailing_system'])
                ->setLogin($_POST['user_email'], $_POST['user_password'])
                ->setFrom($_POST['send_from_email'], $_POST['send_from_name'])
                ->setTo($_POST['send_to_email'], $_POST['send_to_name'])
                ->setSubject($_POST['subject'])
                ->setTemplateBody($_POST)
                ->setDebug( isDebugMode() )
                ;

        // @todo Check for attachments and CC/BCC

        $status_msg = ( ! $mailer->send() )
                        ? "Mailer Error: " . $mail->ErrorInfo
                        : "Message sent!";
    }
    catch(Exception $e)
    {   
        $status_msg = "Exception: ". $e->getMessage();
    }

    $app->flash('alert', $status_msg);
    $app->redirectTo('home');

})->name('send-email');

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