<?php
/**
 * Application class
 */
class Application
{
	/**
	 * @var Page Instance of Page
	 */
	private $model;

	/**
	 * @var View Instance of View
	 */
	private $view;

	/**
	 * @var Controller Instance of Controller
	 */
	private $controller;

    /**
     * Creates a new class instance
	 *
	 * @param string $request_uri Request URI
     */
	public function __construct($request_uri)
	{
		$this->model = new Page(new Database(DATABASE_HOST, DATABASE_PORT, DATABASE_DB, DATABASE_CHARSET, DATABASE_USER, DATABASE_PASS));
		$this->view = new View($this->model);
		$this->controller = new Controller($this->model, new Request());
	}

	/**
	 * Run application
	 */
	public function Run()
	{
		$this->controller->updatePage();
		$this->view->output();
	}
}
?>
