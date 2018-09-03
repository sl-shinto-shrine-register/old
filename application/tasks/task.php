<?php

/**
 * Task class.
 */
abstract class Task {
	
	/**
	 * @var Database Instance of Database.
	 */
	protected $database;
	
	/**
	 * Class constructor.
	 * 
	 * @param Database $database Database connection.
	 */
	public function __construct(Database $database) {
		$this->database = $database;
	}
	
	/**
	 * Run the task
	 * @return void
	 */
	abstract public function run();
}

?>
