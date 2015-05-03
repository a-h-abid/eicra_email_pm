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

    $mail_system = $app->container->get('abd.mailer');
    $mailer = new Eicra\ProjectManager\Mailer\TaskMailer($mail_system);

    try
    {
        $mailer->setTransporter($_POST['mailing_system'])
                ->setLogin($_POST['user_email'], $_POST['user_password'])
                ->setFromReply($_POST['send_from_email'], $_POST['send_from_name'])
                ->setTo($_POST['send_to_email'], $_POST['send_to_name'])
                ->setSubject($_POST['subject'])
                ->setTemplateBody($_POST)
                ->setDebug( isDebugMode() )
                ;

        // @todo Check for attachments and CC/BCC

        $status_msg = ( ! $mailer->send() )
                        ? "Mailer Error: " . $mailer->getError()
                        : "Message sent!";
    }
    catch(Exception $e)
    {   
        $status_msg = "Exception: ". $e->getMessage();
    }

    $app->flash('alert', $status_msg);
    $app->redirectTo('home');

})->name('send-email');

// Jira Login & Fetch Issues
$app->post('/jira/fetch-issues', function() use ($app){
    
    $app->etag('jira-issues-'.date('Y-m-d'));

    try
    {
        $jira = $app->container->get('eicra.jira');
        $jira->login($_POST['jira_username'], $_POST['jira_password']);

        $jira_repo = new Eicra\Jira\IssuesRepository($jira);
        $issues = $jira_repo->getMyOpenIssues();

        $app->expires('+1 hour');

        $json = [
            'status'            => true,
            'issues'            => $issues,
            'jira_status_codes' => Eicra\Jira\StatusCode::getAllStatus(),
        ];
    }
    catch(Exception $e)
    {
        $app->expires('+2 second');

        $json = [
            'status'    => false,
            'errors'    => $e->getMessage(),
        ];
    }

    echo json_encode($json);

})->name('jira-fetch-issues');

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

})->name('jira-test');