<?php


namespace classes\Slack;


class SlackHookReceiver {

    public $data;
    public $error;

    /** Gets data form Jira hook request
     * @return bool
     */
    public function getData()
    {
        $f = fopen('php://input', 'r');

        $data = stream_get_contents($f);

        if ($data)
        {
            $this->data = $_POST;
            return true;
        }
        else
        {
            $this->error='Data is not received!';
            return false;
        }
    }

} 