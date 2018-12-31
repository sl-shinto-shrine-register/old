<?php
/**
 * Article class
 */
class Article extends Model
{
	/**
	 * @var string Database table
	 */
	const DATABASE_TABLE = 'articles';

	/**
	 * @var string Caption
	 */
	protected $caption = '';

	/**
	 * @var string Default caption
	 */
	protected $defaultCaption = '';

	/**
	 * @var string Description
	 */
	private $description = '';

	/**
	 * @var string Link
	 */
	private $link = '';

	/**
	 * @var Owner Article owner
	 */
	private $owner;

	/**
	 * Load article data
	 *
	 * @param int $id Identifier.
	 * @param SimpleLocale $locale Locale.
	 * @return bool TRUE on success or FALSE on failure.
	 */
	public function load($id, SimpleLocale $locale) {
		$lcid = $locale->getCurrentLCID();
		$statement = $this->database->prepare('SELECT caption_en, caption_'.$lcid.', description_'.$lcid.', link, owner_id FROM '.self::DATABASE_TABLE.' WHERE id = :id');
		$statement->bindValue(':id', $id, Database::TYPE_INT);
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			return FALSE;
		} else {
			$this->id = $id;
			$this->caption = $result['caption_'.$lcid];
			$this->defaultCaption = $result['caption_en'];
			$this->description = $result['description_'.$lcid];
			$this->link = $result['link'];
			$this->owner = new Owner($this->database, $result['owner_id'], $locale);
			return TRUE;
		}
	}

	/**
	 * Get caption
	 *
	 * @return string Caption
	 */
	public function getCaption()
	{
		return $this->caption;
	}

	/**
	 * Get default caption.
	 *
	 * @return string Default caption.
	 */
	protected function getDefaultCaption() {
		return $this->defaultCaption;
	}

	/**
	 * Get image
	 *
	 * @param bool $fullResolution Needs to be set to TRUE, if an full resolution image is wanted. Otherwise FALSE (default).
	 * @return string Image
	 */
	public function getImage($fullResolution = false)
	{
		// Get Filename
		$filename = str_replace(' ', '_', $this->getDefaultCaption());
		// Get links
		$smallImageLink = '/images/shrines/small/'.$filename.'.jpg';
		$originalImageLink = '/images/shrines/'.$filename.'.png';
		// Check requested image type
		if ($fullResolution) {
			return $originalImageLink;
		} else {
			// Get path
			$path = BASE_DIRECTORY.'/public';
			// Check
			$sourceImagePath = $path.$originalImageLink;
			$destinationImagePath = $path.$smallImageLink;
			if (!file_exists($destinationImagePath) && file_exists($sourceImagePath)) {
				// Process
				$image = Image::createFromFile($sourceImagePath);
				$image->scale(960, 540);
				$image->saveToFileAs($destinationImagePath, Image::MIME_TYPE_JPEG, 20);
			}
			return $smallImageLink;
		}
	}

	/**
	 * Get description
	 *
	 * @return string Description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get link
	 *
	 * @return string Link
	 */
	public function getLink()
	{
		return 'secondlife://'.$this->link;
	}

	/**
	 * Get the owner of the article.
	 *
	 * @return Owner Returns the Owner.
	 */
	public function getOwner()
	{
		return $this->owner;
	}
}
?>
