<?php

/**
 * File class
 */
class Article extends Model
{
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
	 * Load article data
	 *
	 * @param int $id Identifier
	 *
	 * @return bool TRUE on success or FALSE on failure
	 */
	public function load($id)
	{
		$statement = $this->database->prepare('SELECT caption, description, link FROM articles WHERE id = :id');
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
	 * @return string Image
	 */
	public function getImage()
	{
		// Get Filename
		$filename = str_replace(' ', '_', $this->getCaption());
		// Get paths
		$frontendImageLink = 'images/shrines/small/'.$filename.'.jpg';
		$sourceImagePath = BASE_DIRECTORY.'/../public/images/shrines/'.$filename.'.png';
		$destinationImagePath = BASE_DIRECTORY.'/../public/'.$frontendImageLink;
		// Check
		if (!file_exists($destinationImagePath) && file_exists($sourceImagePath)) {
			// Process
			$image = Image::createFromFile($sourceImagePath);
			$image->scale(960, 540);
			$image->saveToFileAs($destinationImagePath, Image::MIME_TYPE_JPEG, 20);
		}
		return $frontendImageLink;
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
}
?>
