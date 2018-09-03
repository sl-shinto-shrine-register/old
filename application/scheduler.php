<?php

/**
 * Scheduler class.
 */
class Scheduler {
	
	/**
	 * @var Database Instance of Database.
	 */
	protected $database;
	
	/**
	 * @var string[] Array of task class names.
	 */
	protected $tasks;
	
	/**
	 * Class constructor.
	 * @param Database $database Database connection.
	 * @param string[] $tasks Array of task class names.
	 */
	public function __construct(Database $database, array $tasks) {
		$this->database = $database;
		$this->tasks = $tasks;
	}
	
	/**
	 * Run all tasks.
	 * @return void
	 */
	public function run() {
		foreach ($this->tasks as $task) {
			(new $task($this->database))->run();
		}
	}
}

?>
