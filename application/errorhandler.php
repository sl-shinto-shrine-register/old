<?php
/**
 * ErrorHandler class
 */
 class ErrorHandler
 {
 	
	/**
	 * @var int MySQL error code
	 */
	const ERROR_CODE_MYSQL_NOT_AVAILABLE = 1105;
	
 	/**
	 * @var bool Debug mode
	 */
	private $debug;
	
	/**
	 * @var string Webmaster name
	 */
	private $webmater;
	
	/**
	 * @var string Webmaster email address
	 */
	private $webmasterEmail;
	
	/**
	 * @var string Project name
	 */
	private $project;
	
 	/**
	 * @var mixed Error code
	 */
	private $errorCode;
	
	/**
	 * @var string Error message
	 */
	private $errorMessage;
	
	/**
	 * @var string Filename
	 */
	private $filename;
	
	/**
	 * @var int Line number
	 */
	private $line;
	
	/**
	 * @var array Context
	 */
	private $context;
	
	/**
	 * @var string Character set
	 */
	private $charset;
	
 	/**
	 * Creates a new class instance
	 * 
	 * @param bool $debug Debug mode
	 * @param string $webmaster Webmaster name
	 * @param string $webmasterEmail Webmaster email address
	 * @param string $project Project name
	 * @param string $charset Character set
	 */
 	public function __construct($debug, $webmaster, $webmasterEmail, $project, $charset = "utf-8")
	{
		$this->debug = $debug;
		$this->webmater = $webmaster;
		$this->webmasterEmail = $webmasterEmail;
		$this->project = $project;
		$this->charset = $charset;
		set_error_handler(array($this, 'catchError'));
		set_exception_handler(array($this, 'catchError'));
	}
	
	/**
	 * Catch error or exception
	 */
	public function catchError()
	{
		$firstArgument = func_get_arg(0);
		// Checks if it is a Exception or a Error
		if (is_a($firstArgument, 'Exception')) {
			$this->errorCode = $firstArgument->getCode();
			$this->errorMessage = $firstArgument->getMessage();
			$this->filename = $firstArgument->getFile();
			$this->line = $firstArgument->getLine();
			$this->context = $firstArgument->getTrace();
		} else {
			$this->errorCode = func_get_arg(0);
			$this->errorMessage = func_get_arg(1);
			$this->filename = func_get_arg(2);
			$this->line = func_get_arg(3);
			$this->context = func_get_arg(4);
		}
		// Generate report
		$report = $this->generateReport(
			$this->errorCode, 
			$this->errorMessage, 
			$this->filename, 
			$this->line, 
			$this->context, 
			$this->charset
		);
		// Display or send report
		if ($this->debug) {
			die($report);
		} else {
			$this->sendReport(
				$this->webmater.' <'.$this->webmasterEmail.'>', 
				'Error in '.$this->project, 
				$report, 
				$this->charset
			);
			// Exception for network connection errors
			if (strpos($this->errorMessage, 'php_network_getaddresses') !== FALSE) {
				return true;
			}
			die(
				$this->generateUserMessage(
					$this->errorCode,
					$this->webmasterEmail, 
					$this->charset
				)
			);
		}
	}
	
	/**
	 * Generate error report
	 * 
	 * @param mixed $errorCode Error code
	 * @param string $errorMessage Error message
	 * @param string $filename Filename
	 * @param int $line Line number
	 * @param array $context Context
	 * @param string $charset Character set (default: utf-8)
	 * 
	 * @return string Error report
	 */
	private function generateReport($errorCode, $errorMessage, $filename, $line, $context, $charset = "utf-8")
	{
		return '<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset='.$charset.'"/>
  <title>Error</title>
 </head>
 <body>
  <header>
   <h1>Error</h1>
  </header>
  <table>
    <tr>
      <th>Level</th>
      <td>'.$errorCode.'</td>
    </tr>
    <tr>
      <th>Message</th>
      <td>'.$errorMessage.'</td>
    </tr>
    <tr>
      <th>File</th>
      <td>'.$filename.'</td>
    </tr>
    <tr>
      <th>Line</th>
      <td>'.$line.'</td>
    </tr>
    <tr>
      <th>Context</th>
      <td>'.var_export($context, TRUE).'</td>
    </tr>
  </table>
 </body>
</html>';
	}
	
	/**
	 * Generate error message for the user
	 * 
	 * @param int $errorCode Error level
	 * @param string $webmasterEmail Webmaster email address
	 * @param string $charset Character set (default: utf-8)
	 * 
	 * @return string User message
	 */
	private function generateUserMessage($errorCode, $webmasterEmail, $charset = "utf-8")
	{
		// Common stuff
		$header = '<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="msapplication-TileImage" content="/mstile-144x144.png"/>
  <meta name="author" content="Vivien Richter"/>
  <meta name="description" content="The Second Life Shinto Shrine Register (SLSR) is a association of Shinto shrines in Second Life."/>
  <meta name="keywords" content="Second Life, SL, Shinto, shrine register, board"/>
  <title>Second Life Shinto Shrine Register</title>
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
  <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32"/>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"/>
 </head>
 <body>
  ';
		$footer = '
 </body>
</html>
		';
		
		// Different content
		if ($errorCode == self::ERROR_CODE_MYSQL_NOT_AVAILABLE) {
			$content = '<header>
  	<h1>Maintenance in progress..</h1>
  </header>
  <main>
   	<p>We will be back in a few seconds.</p>
   	<p>If you have any questions, please feel free to <a href="mailto:webmaster@slsr.org">contact</a> us.</p>
  </main>';
		} else {
			// General technical error
			$content = '<header>
  	<h1>An error occured.</h1>
  </header>
  <main>
   	<p>We are sorry for the inconvenience.</p>
   	<p>We have been notified and will correct this issue as quickly as possible.</p>
   	<p>For further information, please contact us at <a href="mailto:'.$webmasterEmail.'">'.$webmasterEmail.'</a>.</p>
  </main>';
		}
		
		// Return the whole error page
		return $header.$content.$footer;
	}
	
	/**
	 * Send report as eMail
	 * 
	 * @param string $recipients Recipient(s) (must comply with RFC 2822)
	 * @param string $subject Subject
	 * @param string $report Error report
	 * @param string $charset Character set (default: utf-8)
	 * 
	 * @return bool Returns TRUE if the mail was successfully accepted for delivery, FALSE otherwise.
	 */
	private function sendReport($recipients, $subject, $report, $charset = "utf-8")
	{
		$mail = new Mail(
			$recipients, 
			$subject, 
			$report, 
			$charset
		);
		return $mail->send();
	}
}
?>
