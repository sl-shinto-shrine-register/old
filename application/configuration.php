<?php
/**
 * Configuration class
 */
class Configuration
{
	/**
	 * @var array Configuration values.
	 */
	private $values;
	
	/**
	 * Creates a new class instance.
	 * 
	 * @param string $filename Configuration file.
	 */
	public function __construct($filename)
	{
		if (file_exists($filename)) {
			$this->values = include $filename;
		} else {
			die('Configuration file does not exist');
		}
	}
	
	/**
	 * Get configuration value.
	 * 
	 * @param string $key Configuration key.
	 * @param mixed $default Default value to return, if the key doesn't exist (Default: null).
	 * @return mixed Configuration value.
	 */
	public function get($key, $default = null)
	{
		if (isset($this->values[$key])) {
			return $this->values[$key];
		}
		return $default;
	}
}
?>
