<?php

namespace App\Message\Handlers;

interface HandlerInterface
{
    /**
     * Set the message for the handler
     *
     * @param  string  $messge
     * @return void
     */
    // public function setMessage($message = null);

    /**
     * Get the message on the handler
     *
     * @return string
     */
    // public function getMessage();

    /**
     * Send the text message.
     *
     * @return $result
     */
    public function send($to, $message);
}