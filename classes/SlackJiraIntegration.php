<?php
/**
 * Class for Jira&Slack integration
 */

namespace classes;

use classes\Slack\SlackHookReceiver;


class SlackJiraIntegration {

    public $slackHookUrl='https://hooks.slack.com/services/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';
	public $jiraUrl='https://it-devgroup.atlassian.net/';
    public $slackHookReceiver;

    /**
     * @var string logfile. Please create this directory and set writing permissions!
     */
    protected $logfile="logs/errors.log";
    protected $msgfiles="msg/";

    /**
     * Runs integration
     */
    public function run()
    {
        $this->slackHookReceiver = new SlackHookReceiver();
        if($this->slackHookReceiver->getData()) {
            $this->saveSlackMessage($this->slackHookReceiver->data['channel_name'], $this->slackHookReceiver->data);
        } else {
            $this->log($this->slackHookReceiver->error);
        }

    }

    protected function getSlackMessages($channel_name)
    {
        $messages = [];

        if (is_file($this->msgfiles . $channel_name . '.json')) {
            $messages = json_decode(file_get_contents($this->msgfiles . $channel_name . '.json'), true);
        }

        return $messages;
    }

    protected function saveSlackMessage($channel_name, Array $data)
    {
        $messages = $this->getSlackMessages($channel_name);
        $messages[] = $data;

        file_put_contents($this->msgfiles . $channel_name . '.json', json_encode($messages));
    }

    /** Logger
     * @param $message
     */
    protected function log($message)
    {
        $date=date('d.m.Y H:i:s');
        file_put_contents($this->logfile, "[".$date."] ".$message."\n", FILE_APPEND);
    }
} 