<?php
/**
 * ErrorHandler class
 */
 class ErrorHandler
 {
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
		if ($this->debug) {
			die($this->generateReport());
		} else {
			$this->sendReport($this->generateReport());
			die($this->generateUserMessage());
		}
	}
	
	/**
	 * Generate error report
	 * 
	 * @return string Error report
	 */
	private function generateReport()
	{
		return '<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset='.$this->charset.'"/>
  <title>Error</title>
 </head>
 <body>
  <header>
   <h1>Error</h1>
  </header>
  <table>
    <tr>
      <th>Level</th>
      <td>'.$this->errorCode.'</td>
    </tr>
    <tr>
      <th>Message</th>
      <td>'.$this->errorMessage.'</td>
    </tr>
    <tr>
      <th>File</th>
      <td>'.$this->filename.'</td>
    </tr>
    <tr>
      <th>Line</th>
      <td>'.$this->line.'</td>
    </tr>
    <tr>
      <th>Context</th>
      <td>'.var_export($this->context, TRUE).'</td>
    </tr>
  </table>
 </body>
</html>';
	}
	
	/**
	 * Generate error message for the user
	 * 
	 * @return string User message
	 */
	private function generateUserMessage()
	{
		return '<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset='.$this->charset.'"/>
  <title>Error</title>
 </head>
 <body>
  <header>
   <h1>An error occured.</h1>
  </header>
  <p>I am sorry for the inconvenience. I have been notified and will correct this issue as quickly as possible. For further information, please contact me at <a href="mailto:'.$this->webmasterEmail.'">'.$this->webmasterEmail.'</a>.</p>
 </body>
</html>';
	}
	
	/**
	 * Send report as eMail
	 * 
	 * @param string $report Error report
	 */
	private function sendReport($report)
	{
		$mail = new Mail(
			$this->webmater.' <'.$this->webmasterEmail.'>', 
			'Error in '.$this->project, 
			$report, 
			$this->charset
		);
		$mail->send();
	}
}
?>
