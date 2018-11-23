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
	 * @var Locale Locale.
	 */
	private $locale;

    /**
     * Creates a new class instance
	 *
	 * @param Model $model Instance of model
	 * @param Request $request Instance of request
	 * @param string $client_default Default client page
	 * @param string $web_default Default web page
	 * @param Locale $locale Locale
     */
	public function __construct(Model $model, Request $request, $client_default, $web_default, $locale)
	{
		$this->model = $model;
		$this->request = $request;
		$this->client_default = $client_default;
		$this->web_default = $web_default;
		$this->locale = $locale;
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
		// Detect locale
		$detectedLocale = $this->locale->detectLCIDByRoute($route);
		if (empty($detectedLocale)) {
			$this->locale->setCurrentLCID(
				$this->locale->getDefaultLCID()
			);
		} else {
			$this->locale->setCurrentLCID($detectedLocale);
			array_shift($route);
			if ($detectedLocale == $this->locale->getDefaultLCID()) {
				array_shift($route);
				$this->redirect(implode('/', $route));
				exit;
			}
		}
		// Routing
		if (empty($route[1])) {
			// Redirect to the default page, if the route is empty
			$lcid = $this->locale->getCurrentLCID();
			$this->redirect($lcid.'/'.$this->model->getDefaultPage($lcid));
			exit;
		} else {			
			// Check for a subpage in the route
			if (count($route) > 2) {
				// Try to load the subpage or redirect to the parent page, if failed
				if (!$this->model->load($route[2], $this->locale)) $this->showNotFoundPage('/'.$route[1], true);
			} else {
				// Load the page as normal page
				if (!$this->model->load($route[1], $this->locale)) $this->showNotFoundPage();
			}
		}
	}
	
	/**
	 * Redirect
	 * 
	 * @param string $targetPage Target page
	 */
	protected function redirect($targetPage) {
		//die('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$targetPage);
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$targetPage);
	}
	
	/**
	 * Show 404 Not Found page
	 * 
	 * @param string $backUrl One level upper url
	 * @param bool $subpage Is the missing page a subpage? (Yes: true, default: false)
	 */
	protected function showNotFoundPage($backUrl = '/', $subpage = false) {
		header('HTTP/1.1 404 Not Found');
		include BASE_DIRECTORY.'/templates/not-found.phtml';
		exit;
	}
}
?>
