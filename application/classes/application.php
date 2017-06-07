<?php
/**
 * Application class
 */
class Application
{
	/**
	 * @var Configuration Instance of Configuration
	 */
	private $configuration;
	
	/**
	 * @var ErrorHandler Instance of ErrorHandler
	 */
	private $errorHandler;
	
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
		$this->configuration = new Configuration(
			BASE_DIRECTORY.'/config.php'
		);
		$this->errorHandler = new ErrorHandler(
			$this->configuration->get('debug'), 
			$this->configuration->get('webmaster'), 
			$this->configuration->get('webmaster_email'), 
			$this->configuration->get('project_name'), 
			$this->configuration->get('charset')
		);
		$this->model = new Page(
			new Database(
				$this->configuration->get('database_host'), 
				$this->configuration->get('database_port'), 
				$this->configuration->get('database_db'), 
				$this->configuration->get('database_charset'),
				$this->configuration->get('database_user'), 
				$this->configuration->get('database_password')
			)
		);
		$this->view = new View(
			$this->model, 
			$this->configuration->get('charset')
		);
		$this->controller = new Controller(
			$this->model, 
			new Request(), 
			$this->configuration->get('default_client_page'), 
			$this->configuration->get('default_web_page')
		);
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
