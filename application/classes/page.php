<?php
/**
 * Page class
 */
class Page extends Model
{
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
	 * @return int '0' = OK; '1' = Access denied; '2' = not found
	 * @return bool Returns TRUE, if the page exists. Otherwise FALSE.
	 */
	public function load($name)
	{
		if ($name == 'random') {
			$statement = $this->database->prepare('SELECT id, caption, title, content, type FROM pages WHERE type = 3 ORDER BY rand() LIMIT 1');
		} else {
			$statement = $this->database->prepare('SELECT id, caption, title, content, type FROM pages WHERE name = :name');
			$statement->bindValue(':name', $name, Database::TYPE_STR);
		}
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			// Page not found
			return FALSE;
		}
		$this->id = $result['id'];
		$this->caption = $result['caption'];
		$this->title = $result['title'];
		$this->content = $result['content'];
		$this->type = $result['type'];
		$this->loadArticles();
		return TRUE;
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
	
	/**
	 * Get list of pages
	 * 
	 * @param int[] $types Page types
	 * 
	 * @return array Returns an array, containing the IDs, captions and routes of the pages
	 */
	 public function getPageList(array $types = array())
	 {
	 	$pages = array();
	 	if (empty($types)) {
	 		$statement = $this->database->prepare('SELECT id, name, caption FROM pages');
	 	} else {
	 		$statement = $this->database->prepare('SELECT id, name, caption FROM pages WHERE type = '.implode(' OR type = ', $types));
	 	}
		$statement->execute();
		while ($result = $statement->fetch()) {
			$page['id'] = $result['id'];
			$page['caption'] = $result['caption'];
			$page['route'] = $result['name'];
			$pages[] = $page;
		}
		return $pages;
	 }
}
?>
