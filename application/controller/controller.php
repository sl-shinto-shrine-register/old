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
		// Set page client type
		$this->model->setClientType($this->request->getClientType());
		// Set the default page
		$defaultPage = (($this->request->getClientType() == Request::CLIENT_TYPE_BOARD) ? $this->client_default.'?client=1' : $this->web_default);
		// Parse URL
		$route = explode('/', $this->request->getPath());
		if (empty($route[1])) {
			// Redirect to the default page, if the route is empty
			$this->redirect($defaultPage);
		} else {			
			// Check for a subpage in the route
			if (count($route) > 2) {
				// Try to load the subpage or redirect to the parent page, if failed
				if (!$this->model->load($route[2])) $this->redirect($route[1]);
			} else {
				// Load the page as normal page
				if (!$this->model->load($route[1])) $this->showNotFoundPage();
			}
		}
	}
	
	/**
	 * Redirect
	 * 
	 * @param string $targetPage Target page
	 */
	protected function redirect($targetPage) {
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$targetPage);
	}
	
	/**
	 * Show 404 Not Found page
	 */
	protected function showNotFoundPage() {
		header('HTTP/1.1 404 Not Found');
		die ('<html><head><title>404</title></head><body><h1>Page not found.</h1>'."\n".'<p>Please go to the <a href="/">homepage</a>.</body></html>');
	}
}
?>
