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
     * Creates a new class instance
	 *
	 * @param Model $model Model
     */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * View output
	 */
	public function output()
	{
		include BASE_DIRECTORY.'/templates/page.phtml';
	}
}
?>
