<?php
/**
 * View class
 */
class View
{
	/**
	 * @var Model Instance of model
	 */
	private $model;

	/**
	 * @var string Character set
	 */
	private $charset;

	/**
	 * @var bool Display owners
	 */
	private $displayOwners;

    /**
     * Creates a new class instance
	 *
	 * @param Model $model Model
	 * @param string $charset Character set
	 * @param bool $displayOwners Display owners
     */
	public function __construct(Model $model, $charset = "utf-8", $displayOwners = TRUE)
	{
		$this->model = $model;
		$this->charset = $charset;
		$this->displayOwners = $displayOwners;
	}

	/**
	 * View output
	 */
	public function output()
	{
		include BASE_DIRECTORY.'/templates/'.$this->model->getClientType().'/page.phtml';
	}
}
?>
