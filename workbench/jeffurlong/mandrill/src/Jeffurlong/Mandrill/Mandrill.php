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

    public function __construct(Environment $views)
    {
        $this->views = $views;
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

        $payload = $this->buildMandrillData($message);

        //$message = $message->getSwiftMessage();

        return $this->sendMandrillMessage($payload);
    }

    protected function buildMandrillData($message)
    {
        $data = array(
            'key' => Config::get('mail.password'),
            'message' => array(
                'html' => $message->getBody(),
                'auto_text' => true,
                'subject' => $message->getSubject(),
                'from_email' => $message->getFrom(),
                'to' => $message->getTo(),
            ),
        );

        return $data;
    }


    /**
     * Send a Swift Message instance.
     *
     * @param  Swift_Message  $message
     * @return void
     */
    protected function sendMandrillMessage($message)
    {
        if ( ! $this->pretending)
        {
            return $this->_send($message);
        }
        elseif (isset($this->logger))
        {
            $this->logMessage($message);
        }
    }


    protected function _send($message)
    {
        var_dump($message);
        die();

        $data['key'] = Config::get('mail.password');

        $data['message'] = $message;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::_get_api_url().'messages/send.json');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
        curl_close($ch);
        throw new \Exception('Mandrill error: Curl error');
        }

        curl_close($ch);

        $result = json_decode($response);

        if (isset($result->status) and $result->status === 'error') {
        throw new \Exception('Mandrill error: '.$result->message);
        }

        return true;
    }

}
