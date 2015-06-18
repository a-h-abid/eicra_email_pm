<?php namespace Eicra\Jira;

use Jira\JiraClient;

class IssuesRepository {

    protected $jiraClient;

    public function __construct(JiraClient $jiraClient)
    {
        $this->jiraClient = $jiraClient;
    }

    public function getMyOpenIssues($project = 'TWO')
    {
        $jql = 'project = '.$project.' AND status in ("In Progress", "To Do", "QA") AND resolution = Unresolved AND assignee in (currentUser()) ORDER BY updatedDate DESC';

        return $this->jiraClient->issues()->getFromJqlSearch($jql);
    }

}