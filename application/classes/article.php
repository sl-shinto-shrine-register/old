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
	 * @var string Image
	 */
	private $image = '';

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
		$statement = $this->database->prepare('SELECT caption, image, description, link FROM articles WHERE id = :id');
		$statement->bindValue(':id', $id, Database::TYPE_INT);
		$statement->execute();
		$result = $statement->fetch();
		if (empty($result)) {
			return FALSE;
		} else {
			$this->id = $id;
			$this->caption = $result['caption'];
			$this->image = $result['image'];
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
		return 'img/'.$this->image;
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
