<?php

/**
 * Season class.
 */
class Season {
	
	/**
	 * @var string Winter.
	 */
	const WINTER = 'winter';
	
	/**
	 * @var string Spring.
	 */
	const SPRING = 'spring';
	
	/**
	 * @var string Summer.
	 */
	const SUMMER = 'summer';
	
	/**
	 * @var string Autumn.
	 */
	const AUTUMN = 'autumn';
	
	/**
	 * @var array Seasons map.
	 */
	const MAP = [
		12 => self::WINTER,
		1 => self::WINTER,
		2 => self::WINTER,
		3 => self::SPRING,
		4 => self::SPRING,
		5 => self::SPRING,
		6 => self::SUMMER,
		7 => self::SUMMER,
		8 => self::SUMMER,
		9 => self::AUTUMN,
		10 => self::AUTUMN,
		11 => self::AUTUMN
	];
	
	/**
	 * @var int UNIX timestamp.
	 */
	protected $timestamp;
	
	/**
	 * Sets the timestamp.
	 * @param int $timestamp UNIX timestamp.
	 */
	protected function setTimestamp(int $timestamp) {
		$this->timestamp = $timestamp;
	}
	
	/**
	 * Gets the timestamp.
	 * @return int UNIX timestamp.
	 */
	protected function getTimestamp() {
		return (int) $this->timestamp;
	}
	
	/**
	 * Gets the season name.
	 * @return string Season name.
	 */
	public function getName() {
		return self::MAP[date('n', $this->getTimestamp())];
	}
	
	/**
	 * Class constructor.
	 * @param string $date Date and/or time (default: '' = now).
	 */
	public function __construct(string $date = '') {
		if (empty($date)) {
			$this->setTimestamp(time());
		} else {
			$this->setTimestamp(strtotime($date));
		}
	}
}
