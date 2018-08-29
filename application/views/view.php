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
     * Creates a new class instance
	 *
	 * @param Model $model Model
	 * @param string $charset Character set
     */
	public function __construct(Model $model, $charset = "utf-8")
	{
		$this->model = $model;
		$this->charset = $charset;
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
