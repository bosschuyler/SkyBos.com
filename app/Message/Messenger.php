<?php
namespace App\Message;

use Exception;
use App\Message\Handlers\HandlerInterface;

class Messenger {
	public $handler = null;

	public static $handlers = [];

	public static function addHandler($name, HandlerInterface $handler) {
		self::$handlers[$name] = $handler;
	}

	public function __construct($handlerName) {
		$this->setDefaultHandler($handlerName);
	}

	public function sendSms($to, $message) {
		return $this->handler->send($to, $message);
	}

	public function setDefaultHandler($key) {
		if(!isset(self::$handlers[$key])) {
			throw new Exception("The service handler '{$key}' is not registered");
		} else {
			$this->handler = self::$handlers[$key];
		}
	}
}