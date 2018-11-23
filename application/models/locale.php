<?php
/*
 * Owner class
 */
class Locale extends Model {
	/**
	 * @var string Database table
	 */
	const DATABASE_TABLE = 'pages';
	
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
	 * Class constructor.
	 * 
	 * @param Database $database Database connection.
	 * @param string $defaultLcid Default locale ID.
	 */
	public function __construct(Database $database, string $defaultLcid) {
		parent::__construct($database);
		$this->setDefaultLCID($defaultLcid);
		$availableLCIDs = [];
		$statement = $this->database->prepare('SELECT locale FROM '.self::DATABASE_TABLE.' group by locale');
		$statement->execute();
		while ($result = $statement->fetch()) {
			$availableLCIDs[] = $result['locale'];
		}
		$this->setAvailableLCIDs($availableLCIDs);
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
		$availableLCIDs = $this->getAvailableLCIDs();
		// Decide
		if (in_array($lcid, $availableLCIDs)) return $lcid;
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
}
