<?php
/**
 * Page class
 */
class Page extends Model
{
	/**
	 * @var string Page name
	 */
	private $name;

	/**
	 * @var string Page caption
	 */
	private $caption;

	/**
	 * @var string Page title
	 */
	private $title;
	
	/**
	 * @var string Page content
	 */
	private $content;
	
	/**
	 * @var string Page type
	 */
	private $type;
	
	/**
	 * @var array Articles, listed on the page
	 */
	private $articles = array();

	/**
	 * Load page data
	 *
	 * @param string $name Page name
	 * @param int $client_id Client identifier
	 *
	 * @return int '0' = OK; '1' = Access denied; '2' = not found
	 */
	public function load($name, $client_id)
	{
		$statement = $this->database->prepare('SELECT name FROM pages WHERE type = 1 OR type = 2');
		$statement->execute();
		$exception = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
		if ($this->loadPrivilegues($client_id) || in_array($name, $exception)) {
			if ($name == 'random') {
				$statement = $this->database->prepare('SELECT id, name, caption, title, content, type FROM pages WHERE type = 3 ORDER BY rand() LIMIT 1');
			} else {
				$statement = $this->database->prepare('SELECT id, name, caption, title, content, type FROM pages WHERE name = :name');
				$statement->bindValue(':name', $name, Database::TYPE_STR);
			}
			$statement->execute();
			$result = $statement->fetch();
			if (empty($result)) {
				return 2;
			} else {
				$this->id = $result['id'];
				$this->name = $result['name'];
				$this->caption = $result['caption'];
				$this->title = $result['title'];
				$this->content = $result['content'];
				$this->type = $result['type'];
				$this->loadArticles();
				return 0;
			}
		} else {
			return 1;
		}
	}

	/**
	 * Load articles
	 */
	public function loadArticles()
	{
		$statement = $this->database->prepare('SELECT article_id FROM articles_to_pages WHERE page_id = :page_id');
		$statement->bindValue(':page_id', $this->id, Database::TYPE_INT);
		$statement->execute();
		while ($result = $statement->fetch()) {
			$article = new Article($this->database);
			$article->load($result['article_id']);
			$this->articles[] = $article;
		}
	}

	/**
	 * Load privilegues
	 *
	 * @param int $client_id Client identifier
	 *
	 * @return bool TRUE or FALSE
	 */
	protected function loadPrivilegues($client_id)
	{
		$statement = $this->database->prepare('SELECT COUNT(access) AS counted FROM clients WHERE id = :id AND access = :access');
		$statement->bindValue(':id', $client_id, Database::TYPE_INT);
		$statement->bindValue(':access', TRUE, Database::TYPE_BOOL);
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			return FALSE;
		} else {
			if ($result['counted'] > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * Get page name
	 *
	 * @return string Page name
	 */
	public function getPageName()
	{
		return $this->name;
	}

	/**
	 * Get page caption
	 *
	 * @return string Page caption
	 */
	public function getPageCaption()
	{
		return $this->caption;
	}

	/**
	 * Get page title
	 *
	 * @return string Page title
	 */
	public function getPageTitle()
	{
		return $this->title;
	}
	
	/**
	 * Get page content
	 * 
	 * @return string Page content
	 */
	public function getPageContent()
	{
		return $this->content;
	}
	
	/**
	 * Get page type
	 * 
	 * @return string Page type
	 */
	public function getPageType()
	{
		return $this->type;
	}
	
	/**
	 * Get articles, listed on the page
	 *
	 * @return Article[] Array of article objects
	 */
	public function getArticles()
	{
		return $this->articles;
	}
}
?>
