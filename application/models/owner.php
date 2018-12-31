<?php
/*
 * Owner class
 */
class Owner extends Model {
	/**
	 * @var string Database table
	 */
	const DATABASE_TABLE = 'owners';

	/**
	 * @var string Owner UUID.
	 */
	protected $uuid;

	/**
	 * @var string Owner name.
	 */
	protected $name;

	/**
	 * @var int UNIX timestamp of the last update.
	 */
	protected $lastUpdate;

	/**
	 * @var SimpleLocale Client locale
	 */
	protected $locale;

	/**
	 * Set the owner UUID.
	 *
	 * @param string $uuid Owner UUID.
	 */
	protected function setUUID(string $uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * Set the owner name.
	 *
	 * @param string $name Owner name.
	 */
	protected function setName(string $name) {
		$this->name = $name;
	}

	/**
	 * Set the last update as UNIX timestamp
	 */
	protected function setLastUpdateTimestamp(int $lastUpdate) {
		$this->lastUpdate = $lastUpdate;
	}

	/**
	 * Get the owner UUID.
	 *
	 * @return string Returns the owner UUID.
	 */
	public function getUUID() {
		return $this->uuid;
	}

	/**
	 * Get the owner name.
	 *
	 * @return string Returns the owner name.
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the last update as UNIX timestamp.
	 *
	 * @return string Returns the last update as UNIX timestamp.
	 */
	public function getLastUpdateTimestamp() {
		return $this->lastUpdate;
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

	/**
	 * Class constructor.
	 *
	 * @param Database $database Database connection.
	 * @param string $uuid Owner UUID.
	 * @param SimpleLocale $locale Locale.
	 */
	public function __construct(Database $database, string $uuid, SimpleLocale $locale) {
		parent::__construct($database);
		$this->setUUID($uuid);
		$this->setLocale($locale);
		$result = $this->loadFromDatabase($uuid);
		if (empty($result)) {
			$this->update();
		} else {
			$this->setName($result['name']);
			$this->setLastUpdateTimestamp(strtotime($result['last_update']));
		}
	}

	/**
	 * Get the oldest owner database record.
	 * @param Database $database Database connection.
	 * @return Owner|null Returns an owner object on success. Otherwise null.
	 */
	public static function getOldest(Database $database) {
		$statement = $database->prepare('SELECT id, last_update FROM '.self::DATABASE_TABLE.' ORDER BY last_update ASC LIMIT 1');
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			return null;
		}
		return new self($database, $result['id'], new SimpleLocale($database, 'en', 'utf-8'));
	}

	/**
	 * Update the owner.
	 *
	 * @return bool Returns TRUE, if successfully updated.
	 */
	public function update() {
		$newName = $this->parseNameFromLink($this->getProfileLinkForBrowsers());
		if (!empty($newName)) {
			$this->setName($newName);
			$this->saveToDatabase($this->getUUID(), $this->getName());
		}
	}

	/**
	 * Load from the database.
	 *
	 * @param string $uuid Owner UUID.
	 *
	 * @return array Returns the result array.
	 */
	protected function loadFromDatabase(string $uuid) {
		$statement = $this->database->prepare('SELECT name, last_update FROM '.self::DATABASE_TABLE.' WHERE id = :uuid');
		$statement->bindValue(':uuid', $uuid, Database::TYPE_STR);
		$statement->execute();
		return $statement->fetch();
	}

	/**
	 * Save into the database.
	 *
	 * @param string $uuid Owner UUID.
	 * @param string $name Owner name.
	 *
	 * @return bool Returns TRUE, if successfully saved.
	 */
	protected function saveToDatabase(string $uuid, string $name) {
		$statement = $this->database->prepare('INSERT INTO '.self::DATABASE_TABLE.' (id, name, last_update) VALUES (:uuid, :name, now()) ON DUPLICATE KEY UPDATE name = :name, last_update = now()');
		$statement->bindValue(':uuid', $uuid, Database::TYPE_STR);
		$statement->bindValue(':name', $name, Database::TYPE_STR);
		return $statement->execute();
	}

	/**
	 * Get the owner profile link for browsers.
	 *
	 * @return string Returns the owner profile link for browsers.
	 */
	public function getProfileLinkForBrowsers() {
		$locale = $this->getLocale();
		return 'http://world.secondlife.com/resident/'.$this->getUUID().'?lang='.$locale->getLanguageCode($locale->getCurrentLCID());
	}

	/**
	 * Get the owner profile link for viewers.
	 *
	 * @return string Returns the owner profile link for viewers.
	 */
	public function getProfileLinkForViewers() {
		return 'secondlife://app/agent/'.$this->getUUID().'/about';
	}

	/**
	 * Parse the owner name by it's profile link.
	 *
	 * @param string $profileLink Profile link.
	 * @return string Returns the owner name, if the link is available. Otherwise an empty string.
	 */
	protected function parseNameFromLink(string $profileLink) {
		$dom = new DOMDocument();
		if (strpos(get_headers($profileLink)[0], '200') !== FALSE) {
			$dom->loadHTMLFile($profileLink, LIBXML_NOWARNING | LIBXML_NOERROR);
			return $dom->getElementsByTagName('title')->item(0)->nodeValue;
		} else {
			return '';
		}
	}
}
