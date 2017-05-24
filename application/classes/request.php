<?php
/**
 * Request class
 */
class Request
{
	/**
	 * @var string User request path
	 */
	private $path;

	/**
	 * @var mixed[] User request variables
	 */
	private $variables;

	/**
     * Creates a new class instance
	 */
	public function __construct()
	{
		$this->path = $this->filter(explode('?', $_SERVER['REQUEST_URI'])[0]);
		// Filter and flatten variables
		array_walk_recursive($_REQUEST, function(&$value, &$key) use (&$variables) { $variables[$this->filter($key)] = $this->filter($value); });
		$this->variables = $variables;
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
		return preg_replace("/[^0-9a-zA-Z_.\/-]/", "", $input);
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
		return $this->variables[$id];
	}
}
?>
