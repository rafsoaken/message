<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Message is a class that lets you easily send messages
 * in your application (aka Flash Messages)
 *
 * @package	Message
 * @author	Dave Widmer
 * @see	http://github.com/daveWid/message
 * @see	http://www.davewidmer.net
 * @copyright	2010 © Dave Widmer
 */
class Message_Core
{
	/**
	 * Constants to use for the types of messages that can be set.
	 */
	const ERROR = 'error';
	const NOTICE = 'notice';
	const SUCCESS = 'success';
	const WARN = 'warn';

	/**
	 * @var	mixed	The message to display.
	 */
	public $message;

	/**
	 * @var	string	The type of message.
	 */
	public $type;

	/**
	 * Creates a new Falcon_Message instance.
	 *
	 * @param	string	Type of message
	 * @param	mixed	Message to display, either string or array
	 */
	public function __construct($type, $message)
	{
		$this->type = $type;
		$this->message = $message;
	}

	/**
	 * Clears the message from the session
	 *
	 * @return	void
	 */
	public static function clear()
	{
		Session::instance()->delete('flash_messages');
	}

	/**
	 * Displays the messages
	 *
	 * @return	string	Messages to string
	 */
	public static function display()
	{
		$msg = self::get();

		if (0 < count($msg))
		{
			self::clear();
			return View::factory('message/basic')
				->bind('messages', $msg)
				->render();
		}
		else {
			return '';
		}
	}

	/**
	 * The same as display - used to mold to Kohana standards
	 *
	 * @return	string	HTML for message
	 */
	public static function render()
	{
		return self::display();
	}

	/**
	 * Gets the current message.
	 *
	 * @return	array	The messages
	 */
	public static function get()
	{
		return Session::instance()->get('flash_messages', array());
	}

	/**
	 * Sets a message.
	 *
	 * @param	string	Type of message
	 * @param	mixed	Array/String for the message
	 * @return	void
	 */
	public static function set($type, $message)
	{
		$messages = self::get();
		if (is_string($message))
			$message = array($message);
		foreach ($message as $single_message)
			$messages[] = new Message($type, $single_message);
		Session::instance()->set('flash_messages', $messages);
		unset($messages);
	}

}