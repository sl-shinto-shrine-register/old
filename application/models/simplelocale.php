<?php
/*
 * Owner class
 */
class SimpleLocale extends Model {
	/**
	 * @var string Locales database table
	 */
	const DATABASE_TABLE_LOCALES = 'locales';

	/**
	 * @var string Pages database table
	 */
	const DATABASE_TABLE_PAGES = 'pages';

	/**
	 * @var string Gettext domain.
	 */
	const GETTEXT_DOMAIN = 'main';

	/**
	 * @var string Gettext locales directory.
	 */
	const GETTEXT_LOCALES_DIRECTORY = BASE_DIRECTORY.DIRECTORY_SEPARATOR.'locales';

	/**
	 * @var string Default locale ID.
	 */
	protected $defaultLcid;

	/**
	 * @var string Locale ID.
	 */
	protected $currentLcid;

	/**
	 * @var string[] Available locale ID's.
	 */
	protected $availableLcids = [];

	/**
	 * @var string Charset.
	 */
	protected $charset;

	/**
	 * Set the default locale ID.
	 *
	 * @param string $lcid Locale ID.
	 */
	public function setDefaultLCID(string $lcid) {
		$this->defaultLcid = $lcid;
	}

	/**
	 * Get the default locale ID.
	 *
	 * @param string Returns the default locale ID.
	 */
	public function getDefaultLCID() {
		return $this->defaultLcid;
	}

	/**
	 * Set the current locale ID.
	 *
	 * @param string $lcid Locale ID.
	 */
	public function setCurrentLCID(string $lcid) {
		$this->currentLcid = $lcid;
		$this->initializeGettext(self::GETTEXT_DOMAIN, self::GETTEXT_LOCALES_DIRECTORY, $this->getCharset(), $lcid);
	}

	/**
	 * Get the current locale ID.
	 *
	 * @return string Returns the current locale ID.
	 */
	public function getCurrentLCID() {
		return $this->currentLcid;
	}

	/**
	 * Set the available locale ID's.
	 *
	 * @param string[] Available locale ID's.
	 */
	public function setAvailableLCIDs(array $availableLcids) {
		$this->availableLcids = $availableLcids;
	}

	/**
	 * Get the available locale ID's.
	 *
	 * @return string[] Returns the available locale ID's.
	 */
	public function getAvailableLCIDs() {
		return $this->availableLcids;
	}

	/**
	 * Sets the charset.
	 *
	 * @param string $charset Charset.
	 */
	public function setCharset(string $charset) {
		$this->charset = $charset;
	}

	/**
	 * Gets the charset.
	 *
	 * @return string Charset.
	 */
	public function getCharset() {
		return $this->charset;
	}

	/**
	 * Class constructor.
	 *
	 * @param Database $database Database connection.
	 * @param string $defaultLcid Default locale ID.
	 * @param string $charset Charset.
	 */
	public function __construct(Database $database, string $defaultLcid, string $charset) {
		parent::__construct($database);
		$this->setCharset($charset);
		$this->setDefaultLCID($defaultLcid);
		$this->setCurrentLCID($defaultLcid);
		$this->setAvailableLCIDs($this->loadAvailableLCIDs($database));
	}

	/**
	 * Initialize Getttext.
	 *
	 * @param string $domain Gettext domain.
	 * @param string $localesDirectory Gettext locales directory.
	 * @param string $charset Charset.
	 * @param string $lcid Locale ID.
	 */
	protected function initializeGettext(string $domain, string $localesDirectory, string $charset, string $lcid) {
		setlocale(LC_ALL, 'C.'.strtoupper($charset));
		bindtextdomain($domain, $localesDirectory.DIRECTORY_SEPARATOR.$lcid);
		bind_textdomain_codeset($domain, $charset);
		textdomain($domain);
	}

	/**
	 * Loads all available locale ID's
	 *
	 * @param Database $database Database connection.
	 * @return array Available locale ID's.
	 */
	protected function loadAvailableLCIDs(Database $database) {
		$availableLCIDs = [];
		$statement = $this->database->prepare('SELECT '.self::DATABASE_TABLE_PAGES.'.locale, '.self::DATABASE_TABLE_LOCALES.'.description FROM '.self::DATABASE_TABLE_PAGES.' INNER JOIN '.self::DATABASE_TABLE_LOCALES.' ON ('.self::DATABASE_TABLE_PAGES.'.locale = '.self::DATABASE_TABLE_LOCALES.'.locale) group by locale, description');
		$statement->execute();
		while ($result = $statement->fetch()) {
			$availableLCIDs[$result['locale']] = $result['description'];
		}
		//die(var_dump($availableLCIDs));
		return $availableLCIDs;
	}

	/**
	 * Detects the current locale by the route.
	 *
	 * @param string[] $route Route.
	 * @return string Locale ID.
	 */
	public function detectLCIDByRoute(array $route) {
		// Format
		$lcid = explode('-', $route[1]);
		if (count($lcid) > 1) {
			$lcid[0] = strtolower($lcid[0]);
			$lcid[1] = strtoupper($lcid[1]);
		}
		$lcid = implode('_', $lcid);
		// Check
		if (array_key_exists($lcid, $this->getAvailableLCIDs())) return $lcid;
		return '';
	}

	/**
	 * Localizes an URL.
	 *
	 * @param string $url Original URL.
	 * @return string Localized URL.
	 */
	public function localizeUrl(string $url) {
		$currentLCID = $this->getCurrentLCID();
		if ($currentLCID != $this->getDefaultLCID()) return '/'.strtolower(str_replace('_', '-', $currentLCID)).$url;
		return $url;
	}

	/**
	 * Get the language code of a locale ID.
	 *
	 * @param string $lcid Locale ID.
	 * @return string Language code.
	 */
	static function getLanguageCode(string $lcid) {
		$delimiter = strpos($lcid, '_');
		if ($delimiter === FALSE) return $lcid;
		return strtolower(substr($lcid, 0, $delimiter));
	}

	/**
	 * Detect the language by it's typical characters.
	 * Source: https://stackoverflow.com/questions/2856942/how-to-check-if-the-word-is-japanese-or-english-using-php
	 *
	 * @param string $text Text.
	 * @return string Language ID.
	 */
	static function detectLanguage(string $text) {
		// Japanese
		$containsKanji = (preg_match('/[\x{4E00}-\x{9FBF}]/u', $text) > 0);
		$containsHiragana = (preg_match('/[\x{3040}-\x{309F}]/u', $text) > 0);
		$containsKatakana = (preg_match('/[\x{30A0}-\x{30FF}]/u', $text) > 0);
		if ($containsKanji || $containsHiragana || $containsKatakana) return 'ja';
		// German
		$containsUmlauts = (preg_match('/[\x{00C4}\x{00D6}\x{00DC}\x{00E4}\x{00F6}\x{00FC}\x{00DF}\x{1E9E}]/u', $text) > 0);
		if ($containsUmlauts) return 'de';
		// English
		return 'en';
	}
}
