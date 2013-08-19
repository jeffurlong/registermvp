<?php namespace Jeffurlong\Mandrill;

use Config;
use Closure;
use Swift_Mailer;
use Swift_Message;
use Illuminate\Log\Writer;

use \Illuminate\Mail\Mailer;

use Illuminate\View\Environment;
use Illuminate\Queue\QueueManager;
use Illuminate\Container\Container;
use Illuminate\Support\SerializableClosure;

class Mandrill extends Mailer {

    public $ch;

    public function __construct(Environment $views)
    {
        $this->views = $views;
        $this->ch = curl_init();
    }

    /**
     * Send a new message using a view.
     *
     * @param  string|array  $view
     * @param  array  $data
     * @param  Closure|string  $callback
     * @return void
     */
    public function send($view, array $data, $callback)
    {
        // First we need to parse the view, which could either be a string or an array
        // containing both an HTML and plain text versions of the view which should
        // be used when sending an e-mail. We will extract both of them out here.
        list($view, $plain) = $this->parseView($view);

        $data['message'] = $message = $this->createMessage();

        $this->callMessageBuilder($callback, $message);

        // Once we have retrieved the view content for the e-mail we will set the body
        // of this message using the HTML type, which will provide a simple wrapper
        // to creating view based emails that are able to receive arrays of data.
        $this->addContent($message, $view, $plain, $data);

        $mandrill_data = $this->buildMandrillData($message);

        //$message = $message->getSwiftMessage();

        return $this->sendMandrillMessage($mandrill_data);
    }

    protected function buildMandrillData($message)
    {
        $data = array(
            'key'       => Config::get('mail.password'),
            'message'   => array(
                'html'          => $message->getBody(),
                'auto_text'     => true,
                'subject'       => $message->getSubject(),
                'from_email'    => $this->parseFromEmail($message->getFrom()),
                'to'            => $this->parseTo($message->getTo()),
            ),
        );

        if ($from_name = $this->parseFromName($message->getFrom()))
        {
            $data['from_name'] = $from_name;
        }

        return $data;
    }

    protected function parseFromEmail($from)
    {
        return (is_array($from)) ? key($from) : $from;
    }

    protected static function parseFromName($from)
    {
        return (is_array($from)) ? $from[key($from)] : null;
    }

    protected static function parseTo($to)
    {
        $return = array();

        foreach($to as $key => $value) {
          $return[] = (is_string($key)) ? array('email' => $key, 'name' => $value) : array('email' => $value);
        }

        return $return;
    }

    /**
     * Send a Mandrill Message.
     *
     * @param  Swift_Message  $message
     * @return void
     */
    protected function sendMandrillMessage($message)
    {
        if ( ! $this->pretending)
        {
            return $this->callMandrill('messages/send.json', $message);
        }
        elseif (isset($this->logger))
        {
            $this->logMessage($message);
        }
    }

    /*

     */
    protected function callMandrill($request, $data)
    {
        $ch = $this->ch;

        curl_setopt($ch,    CURLOPT_URL,               Config::get('mail.host').$request);
        curl_setopt($ch,    CURLOPT_POSTFIELDS,        json_encode($data));
        curl_setopt($ch,    CURLOPT_HTTPHEADER,        array('Content-Type: application/json'));
        curl_setopt($ch,    CURLOPT_SSL_VERIFYHOST,    2);
        curl_setopt($ch,    CURLOPT_TIMEOUT,           30);
        curl_setopt($ch,    CURLOPT_POST,              true);
        curl_setopt($ch,    CURLOPT_RETURNTRANSFER,    true);
        curl_setopt($ch,    CURLOPT_SSL_VERIFYPEER,    true);

        $response = curl_exec($ch);

        $info = curl_getinfo($ch);

        if (curl_error($ch))
        {
            throw new \RuntimeException("Mandrill error: [curl] " . curl_error($ch));
        }

        $result = json_decode($response);

        if ($result === null)
        {
            throw new \RuntimeException('Mandrill error: Unable to decode response.');
        }

        if (floor($info['http_code'] / 100) >= 4)
        {
            throw new \RuntimeException('Mandrill error: '.json_encode($result));
        }

        return true;
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

}
