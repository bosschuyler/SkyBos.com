<?php
namespace App\Message\Handlers;

use Services_Twilio;

/**********************************
 * Creating the twilio provider class which will implement the ProviderInterface.  This allows
 * separating the code for the application which will use the SMS service away from the actual
 * implementation of the SMS providers.  to swap a provider simply setting up an abstract 
 * for the new provider which implements the ProviderInterface will allow a drop in replacement.
 */

class TwilioHandler implements HandlerInterface
{
    public $client = null;

    public $from = null;

    public function __construct(Services_Twilio $client, $application_sid) {
        $this->client = $client;
        $this->application_sid = $application_sid;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function send($to, $message) {
        if(strlen($to) == 10) {
			$to = "+1".$to;
		} else {
			$to = "+".$to;
		}

        return $response = $this->client->account->messages->create(array(
            'To'=>$to,
            'From'=>$this->from,
            'ApplicationSid'=>$this->application_sid,
            'Body'=>$message
        ));
    }


}