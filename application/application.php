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
	 * @var Database Instance of Database
	 */
	private $database;

	/**
	 * @var Scheduler Instance of Scheduler
	 */
	private $scheduler;

	/**
	 * @var Page Instance of Page
	 */
	private $model;

	/**
	 * @var View Instance of View
	 */
	private $view;

	/**
	 * @var SimpleLocale Instance of SimpleLocale
	 */
	private $locale;

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
			BASE_DIRECTORY.'/configuration.php'
		);
		$this->errorHandler = new ErrorHandler(
			$this->configuration->get('debug'),
			$this->configuration->get('webmaster'),
			$this->configuration->get('webmaster_email'),
			$this->configuration->get('project_name'),
			$this->configuration->get('charset')
		);
		$this->database = new Database(
			$this->configuration->get('database_host'),
			$this->configuration->get('database_port'),
			$this->configuration->get('database_db'),
			$this->configuration->get('database_charset'),
			$this->configuration->get('database_user'),
			$this->configuration->get('database_password')
		);
		$this->scheduler = new Scheduler(
			$this->database,
			$this->configuration->get('tasks', array())
		);
		$this->model = new Page(
			$this->database
		);
		$this->locale = new SimpleLocale(
			$this->database,
			$this->configuration->get('default_locale'),
			$this->configuration->get('charset')
		);
		$this->view = new View(
			$this->model,
			$this->configuration->get('charset'),
			$this->configuration->get('display_owners')
		);
		$this->controller = new Controller(
			$this->model,
			new Request(),
			$this->configuration->get('default_client_page'),
			$this->configuration->get('default_web_page'),
			$this->locale
		);
	}

	/**
	 * Run application
	 */
	public function Run()
	{
		$this->scheduler->run();
		$this->controller->updatePage();
		$this->view->output();
	}
}
?>
