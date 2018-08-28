<?php
/**
 * View class
 */
class Controller
{
	/**
	 * @var Model Instance of model
	 */
	private $model;

	/**
	 * @var Request Instance of request
	 */
	private $request;

	/**
	 * @var string Default client page
	 */
	private $client_default;

	/**
	 * @var string Default web page
	 */
	private $web_default;

    /**
     * Creates a new class instance
	 *
	 * @param Model $model Instance of model
	 * @param Request $request Instance of request
	 * @param string $client_default Default client page
	 * @param string $web_default Default web page
     */
	public function __construct(Model $model, Request $request, $client_default, $web_default)
	{
		$this->model = $model;
		$this->request = $request;
		$this->client_default = $client_default;
		$this->web_default = $web_default;
	}

	/**
	 * Page update
	 */
	public function updatePage()
	{
		// Get client type
		if (empty($this->request->getVariable('client'))) {
			// Set page type
			$this->model->setClientType(Page::CLIENT_TYPE_BROWSER);
			// Set the default page
			$defaultPage = $this->web_default;
		} else {
			// Set page type
			$this->model->setClientType(Page::CLIENT_TYPE_BOARD);
			// Set the default page
			$defaultPage = $this->client_default.'?client=1';
		}
		// Parse URL
		$route = explode('/', $this->request->getPath());
		if (empty($route[1])) {
			// Redirect to the default page
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$defaultPage);
		} else {
			// Page not found
			if (!$this->model->load($route[1])) {
				header('HTTP/1.0 404 Not Found');
				die ('<html><head><title>404</title></head><body><h1>Page not found.</h1>'."\n".'<p>Please go to the <a href="/">homepage</a>.</body></html>');
			}
			
		}
	}
}
?>
