<?php
header('Content-Type: text/html; charset=utf-8');
use classes\SlackJiraIntegration;

spl_autoload_register(function ($class) {
    require_once str_replace('\\', '/', $class). '.php';
});

$slackJiraIntegration = new SlackJiraIntegration();
$slackJiraIntegration->run();