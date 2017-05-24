<?php
/**
 * Statement class
 */
class Statement
{
	/**
	 * @var PDOStatement Instance of PDOStatement
	 */
	private $statement;

	/**
	 * Creates a new class instance
	 *
	 * @param PDOStatement $statement Instance of PDOStatement
	 */
	public function __construct($statement)
	{
		$this->statement = $statement;
	}

	/**
	 * Binds a value to a parameter
	 *
	 * @param string $parameter Parameter identifier like ':name'
	 * @param mixed $value Value to bind to the parameter
	 * @param int $type Data type for the parameter using the Database::TYPE_* constants
	 *
	 * @return bool TRUE on success or FALSE on failure
	 */
	public function bindValue($parameter, $value, $type)
	{
		$this->statement->bindValue($parameter, $value, $type);
	}

	/**
	 * Executes a prepared statement
	 *
	 * @return bool TRUE on success or FALSE on failure
	 */
	public function execute()
	{
		$this->statement->execute();
	}

	/**
	 * Fetches the next row from the result set
	 *
	 * @return array|bool The row or FALSE on failure
	 */
	public function fetch()
	{
		return $this->statement->fetch();
	}
}
?>
