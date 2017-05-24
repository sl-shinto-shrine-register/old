<?php
/**
 * Error handling
 *
 * @param int|string $errno Level of the error
 * @param string $errstr Error message
 * @param string $errfile Filename that the error was raised in
 * @param int $errline Line number the error was raised at
 * @param array $errcontext Every variable that existed in the scope the error was triggered in.
 */
function error($errno, $errstr, $errfile, $errline, array $errcontext) {
	$report = '<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Error</title>
 </head>
 <body>
  <header>
   <h1>Error</h1>
  </header>
  <table>
    <tr>
      <th>Level</th>
      <td>'.$errno.'</td>
    </tr>
    <tr>
      <th>Message</th>
      <td>'.$errstr.'</td>
    </tr>
    <tr>
      <th>File</th>
      <td>'.$errfile.'</td>
    </tr>
    <tr>
      <th>Line</th>
      <td>'.$errline.'</td>
    </tr>
    <tr>
      <th>Context</th>
      <td>'.var_export($errcontext, TRUE).'</td>
    </tr>
  </table>
 </body>
</html>';
	if (DEBUG) {
		die($report);
	} else {
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=UTF-8\r\n";
		mail(WEBMASTER_NAME.' <'.WEBMASTER_MAIL.'>', 'Error in '.PROJECT_NAME, $report, $header);
		die('<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Error</title>
 </head>
 <body>
  <header>
   <h1>An error occured.</h1>
  </header>
  <p>I am sorry for the inconvenience. I have been notified and will correct this issue as quickly as possible. For further information, please contact me at <a href="mailto:'.WEBMASTER_MAIL.'">'.WEBMASTER_MAIL.'</a>.</p>
 </body>
</html>');
	}
}

/**
 * Sets a user-defined error handler function
 *
 * @param callable $error_handler A callback with the following signature. NULL may be passed instead, to reset this handler to its default state. Instead of a function name, an array containing an object reference and a method name can also be supplied.
 * @param int $error_types Can be used to mask the triggering of the error_handler function just like the error_reporting ini setting controls which errors are shown. Without this mask set the error_handler will be called for every error regardless to the setting of the error_reporting setting.
 *
 * @return string|null|array Returns a string containing the previously defined error handler (if any). If the built-in error handler is used NULL is returned. NULL is also returned in case of an error such as an invalid callback. If the previous error handler was a class method, this function will return an indexed array with the class and the method name.
 */
set_error_handler('error');

/**
 * Exception handling
 *
 * @param mixed $exception Error or Exception
 */
function exception($exception) {
	error($exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getTrace());	
}

/**
 * Sets a user-defined exception handler function
 *
 * @param callable $exception_handler Name of the function to be called when an uncaught exception occurs
 *
 * @return callable|NULL Name of the previously defined exception handler, or NULL on error. If no previous handler was defined, NULL is also returned
 */
set_exception_handler('exception');
?>
