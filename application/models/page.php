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
	 * @var string Page description
	 */
	private $description;

	/**
	 * @var string Page keywords
	 */
	private $keywords;

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
	 * @var SimpleLocale Client locale
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
	 * @param SimpleLocale $locale Locale
	 * @return bool Returns TRUE, if the page exists. Otherwise FALSE.
	 */
	public function load(string $name, SimpleLocale $locale)
	{
		if ($name == 'random') {
			$statement = $this->database->prepare('SELECT id, caption, title, description, keywords, content, type FROM '.self::DATABASE_TABLE.' WHERE type = 0 ORDER BY rand() LIMIT 1');
		} else {
			$statement = $this->database->prepare('SELECT id, caption, title, description, keywords, content, type FROM '.self::DATABASE_TABLE.' WHERE name = :name AND locale = :locale');
			$statement->bindValue(':name', $name, Database::TYPE_STR);
			$statement->bindValue(':locale', $locale->getCurrentLCID(), Database::TYPE_STR);
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
		$this->description = $result['description'];
		$this->keywords = $result['keywords'];
		$this->content = $result['content'];
		$this->type = $result['type'];
		$this->setLocale($locale);
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
			$article->load($result['article_id'], $this->getLocale());
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
	 	}
		$statement->execute();
		while ($result = $statement->fetch()) {
			$page['id'] = $result['id'];
			$page['caption'] = $result['caption'];
			$page['name'] = $result['name'];
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
	 * Get URL.
	 *
	 * @param string $locale Locale ID.
	 * @return string URL.
	 */
	public function getUrl(string $locale) {
		$statement = $this->database->prepare('SELECT subpage.name AS page, parentpage.name AS parent FROM '.self::DATABASE_TABLE.' subpage LEFT JOIN '.self::DATABASE_TABLE.' parentpage ON (parentpage.id = subpage.parent_page_id) WHERE (subpage.locale = \''.$locale.'\' AND subpage.group_id = (SELECT group_id FROM '.self::DATABASE_TABLE.' WHERE id = '.$this->getID().'))');
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			trigger_error('No alternate page of \''.$this->getID().'\' for locale \''.$locale.'\' found.', E_USER_ERROR);
		}
		return 'http://'.$_SERVER['SERVER_NAME'].'/'.$locale.'/'.((empty($result['parent'])) ? '' : $result['parent'].'/').$result['page'];
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
	 * Get page description.
	 *
	 * @return string Page description.
	 */
	public function getPageDescription() {
		return $this->description;
	}

	/**
	 * Get page keywords.
	 *
	 * @return string Page keywords.
	 */
	public function getPageKeywords() {
		return $this->keywords;
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
	 * @param SimpleLocale $locale Client locale
	 */
	public function setLocale(SimpleLocale $locale) {
		$this->locale = $locale;
	}

	/**
	 * Get client locale
	 *
	 * @return SimpleLocale Client locale
	 */
	public function getLocale() {
		return $this->locale;
	}
}
?>
