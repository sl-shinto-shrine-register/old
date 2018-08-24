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
		// Parse URL
		$route = explode('/', $this->request->getPath());
		if (empty($route[1])) {
			// Default page
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$this->web_default);
		} else {
			// Page not found
			if (!$this->model->load($route[1])) {
				if ($route[1] == 'not-found') {
					// Can't find the not-found page
					trigger_error('404 Page not found.', E_USER_ERROR);
				}
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/not-found');
			}
		}
	}
}
?>
