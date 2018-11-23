<?php
/**
 * Page class
 */
class Page extends Model
{
	/**
	 * @var string Database table
	 */
	const DATABASE_TABLE = 'pages';
	
	/**
	 * @var int Page type: Default
	 */
	const PAGE_TYPE_DEFAULT = 3;
	
	/**
	 * @var int Page type: Normal
	 */
	const PAGE_TYPE_NORMAL = 1;
	
	/**
	 * @var int Page type: Category
	 */
	const PAGE_TYPE_CATEGORY = 2;
	
	/**
	 * @var int Page type: Subpage
	 */
	const PAGE_TYPE_SUBPAGE = 0;
	
	/**
	 * @var int Client type: Board
	 */
	const CLIENT_TYPE_BOARD = 'board';
	
	/**
	 * @var int Client type: Browser
	 */
	const CLIENT_TYPE_BROWSER = 'browser';
	
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
	 * @var string Client type
	 */
	private $clientType;
	
	/**
	 * @var Locale Client locale
	 */
	private $locale;
	
	/**
	 * @var array Articles, listed on the page
	 */
	private $articles = array();

	/**
	 * Load page data
	 *
	 * @param string $name Page name
	 * @param Locale $locale Locale
	 * @return bool Returns TRUE, if the page exists. Otherwise FALSE.
	 */
	public function load(string $name, Locale $locale)
	{
		if (empty($name)) {
			$statement = $this->database->prepare('SELECT id, caption, title, content, type FROM '.self::DATABASE_TABLE.' WHERE type = 3 AND locale = \''.$locale->getCurrentLCID().'\'');
		} elseif ($name == 'random') {
			$statement = $this->database->prepare('SELECT id, caption, title, content, type FROM '.self::DATABASE_TABLE.' WHERE type = 0 ORDER BY rand() LIMIT 1');
		} else {
			$statement = $this->database->prepare('SELECT id, caption, title, content, type FROM '.self::DATABASE_TABLE.' WHERE name = :name');
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
		$this->locale = $locale;
		$this->loadArticles();
		return TRUE;
	}

	/**
	 * Load articles
	 */
	public function loadArticles()
	{
		$statement = $this->database->prepare('SELECT article_id FROM '.Article::DATABASE_TABLE.'_to_'.Page::DATABASE_TABLE.' WHERE page_id = :page_id');
		$statement->bindValue(':page_id', $this->id, Database::TYPE_INT);
		$statement->execute();
		while ($result = $statement->fetch()) {
			$article = new Article($this->database);
			$article->load($result['article_id']);
			$this->articles[] = $article;
		}
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
	 		$statement = $this->database->prepare('SELECT id, name, caption, type FROM '.self::DATABASE_TABLE);
	 	} else {
	 		$statement = $this->database->prepare('SELECT id, name, caption, type FROM '.self::DATABASE_TABLE.' WHERE ( type = '.implode(' OR type = ', $types).' ) AND locale = \''.$this->getLocale()->getCurrentLCID().'\'');
	 		//$statement = $this->database->prepare('SELECT id, name, caption, type FROM '.self::DATABASE_TABLE.' WHERE type = '.implode(' OR type = ', $types));
	 	}
		$statement->execute();
		while ($result = $statement->fetch()) {
			$page['id'] = $result['id'];
			$page['caption'] = $result['caption'];
			$page['route'] = $result['name'];
			$page['type'] = $result['type'];
			$pages[] = $page;
		}
		return $pages;
	}
	
	/**
	 * Get the default page.
	 * 
	 * @param string $lcid Locale ID.
	 * @return string Name of the default page.
	 */
	public function getDefaultPage(string $lcid) {
		$statement = $this->database->prepare('SELECT name FROM '.self::DATABASE_TABLE.' WHERE type = 3 AND locale = \''.$lcid.'\'');
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			trigger_error('No default page for locale \''.$lcid.'\' found.', E_USER_ERROR);
		}
		return $result['name'];
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
	 * Get client type
	 * 
	 * @return string Client type
	 */
	public function getClientType()
	{
		return $this->clientType;
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
	 * Set page type
	 * 
	 * @param int $pageType Page type
	 */
	public function setPageType(int $pageType)
	{
		$this->type = $pageType;
	}
	
	/**
	 * Set client type
	 * 
	 * @param string $clientType Client type
	 */
	public function setClientType(string $clientType)
	{
		$this->clientType = $clientType;
	}
	
	/**
	 * Set client locale
	 * 
	 * @param Locale $locale Client locale
	 */
	public function setLocale(Locale $locale)
	{
		$this->locale = $locale;
	}
	
	/**
	 * Get client locale
	 * 
	 * @return Locale Client locale
	 */
	public function getLocale()
	{
		return $this->locale;
	}
}
?>
