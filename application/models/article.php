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
	 * @param int $id Identifier
	 *
	 * @return bool TRUE on success or FALSE on failure
	 */
	public function load($id)
	{
		$statement = $this->database->prepare('SELECT caption, description, link, owner_id FROM '.self::DATABASE_TABLE.' WHERE id = :id');
		$statement->bindValue(':id', $id, Database::TYPE_INT);
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			return FALSE;
		} else {
			$this->id = $id;
			$this->caption = $result['caption'];
			$this->description = $result['description'];
			$this->link = $result['link'];
			$this->owner = new Owner($this->database, $result['owner_id']);
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
	 * Get image
	 *
	 * @param bool $fullResolution Needs to be set to TRUE, if an full resolution image is wanted. Otherwise FALSE (default).
	 * @return string Image
	 */
	public function getImage($fullResolution = false)
	{
		// Get Filename
		$filename = str_replace(' ', '_', $this->getCaption());
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
