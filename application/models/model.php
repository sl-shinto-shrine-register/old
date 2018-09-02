<?php
/**
 * Model class
 */
abstract class Model
{
	/**
	 * @var string Database table
	 */
	const DATABASE_TABLE = '';
	
	/**
	 * @var int Identifier
	 */
	protected $id = 0;

	/**
	 * @var Database Instance of Database
	 */
	protected $database;

    /**
     * Creates a new class instance
	 *
	 * @param Database $database Database connection
     */
	public function __construct(Database $database)
	{
		$this->database = $database;
	}
	
	/**
	 * Get identifier
	 *
	 * @return int Identifier
	 */
	public function getID()
	{
		return $this->id;
	}
}
?>
