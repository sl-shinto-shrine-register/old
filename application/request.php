<?php
/**
 * Request class
 */
class Request
{
	/**
	 * @var int Client type: Board
	 */
	const CLIENT_TYPE_BOARD = 'board';

	/**
	 * @var int Client type: Browser
	 */
	const CLIENT_TYPE_BROWSER = 'browser';

	/**
	 * @var string User request path
	 */
	protected $path;

	/**
	 * @var mixed[] User request variables
	 */
	protected $variables;

	/**
	 * @var string Client type
	 */
	protected $clientType;

	/**
	 * Creates a new class instance
	 */
	public function __construct()
	{
		// Get the path
		$this->path = $this->filter(explode('?', $_SERVER['REQUEST_URI'])[0]);
		// Filter and flatten variables
		array_walk_recursive($_REQUEST, function(&$value, &$key) use (&$variables) { $variables[$this->filter($key)] = $this->filter($value); });
		$this->variables = $variables;
		// Detect the client type
		$this->setClientType($this->detectClientType());
	}

	/**
	 * Filter
	 *
	 * @param string $input Input
	 *
	 * @return string Output
	 */
	private function filter($input)
	{
		return filter_var(urldecode($input), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	}

	/**
	 * Get Path
	 *
	 * @return string Path
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Get variable
	 *
	 * @param string Identifier
	 *
	 * @return mixed Variable
	 */
	public function getVariable($id)
	{
		if (isset($this->variables[$id])) {
			return $this->variables[$id];
		} else {
			return null;
		}
	}

	/**
	 * Set the client type.
	 * @param string $clientType Client type.
	 */
	protected function setClientType(string $clientType)
	{
		$this->clientType = $clientType;
	}

	/**
	 * Get the client type.
	 * @return string Client type.
	 */
	public function getClientType()
	{
		return $this->clientType;
	}

	/**
	 * Detects the client type.
	 * @return string Returns the client type.
	 */
	protected function detectClientType()
	{
		if (empty($this->getVariable('client')) && empty($this->getVariable('id'))) {
			return self::CLIENT_TYPE_BROWSER;
		} else {
			return self::CLIENT_TYPE_BOARD;
		}
	}
}
?>
