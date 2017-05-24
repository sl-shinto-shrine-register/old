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
	 * @var string Default page
	 */
	private $default;

    /**
     * Creates a new class instance
	 *
	 * @param Model $model Instance of model
	 * @param Request $request Instance of request
	 * @param string $default Default page
     */
	public function __construct(Model $model, Request $request, $default)
	{
		$this->model = $model;
		$this->request = $request;
		$this->default = $default;
	}

	/**
	 * Page update
	 */
	public function updatePage()
	{
		$route = explode('/', $this->request->getPath());
		if (empty($route[1])) {
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$this->default.'?client='.$this->request->getVariable('client'));
		} else {
			$page = $this->model->load($route[1], $this->request->getVariable('client'));
			if ($page > 0) {
				if ($page == 1) {
					$route[1] = 'access-denied';
				} elseif ($page == 2) {
					if ($route[1] == 'access-denied' || $route[1] == 'not-found') {
						trigger_error('No valid page found.', E_USER_ERROR);
					} else {
						$route[1] = 'not-found';
					}
				}
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$route[1]);
			}
		}
	}
}
?>
