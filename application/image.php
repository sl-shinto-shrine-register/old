<?php

/**
 * Image class
 */
class Image {
	
	/**
	 * @var string GIF MIME type
	 */
	const MIME_TYPE_GIF = 'image/gif';
	
	/**
	 * @var string JPEG MIME type
	 */
	const MIME_TYPE_JPEG = 'image/jpeg';
	
	/**
	 * @var string PNG MIME type
	 */
	const MIME_TYPE_PNG = 'image/png';
	
	/**
	 * @var string BMP MIME type
	 */
	const MIME_TYPE_BMP = 'image/bmp';
	
	/**
	 * @var string WEBP MIME type
	 */
	const MIME_TYPE_WEBP = 'image/webp';
	
	/**
	 * @var int 'BELL' scale mode
	 */
	const SCALE_MODE_BELL = IMG_BELL;

	/**
	 * @var int 'BESSEL' scale mode
	 */
	const SCALE_MODE_BESSEL = IMG_BESSEL;

	/**
	 * @var int 'BILINEAR FIXED' scale mode
	 */
	const SCALE_MODE_BILINEAR_FIXED = IMG_BILINEAR_FIXED;

	/**
	 * @var int 'BICUBIC' scale mode
	 */
	const SCALE_MODE_BICUBIC = IMG_BICUBIC;

	/**
	 * @var int 'BICUBIC FIXED' scale mode
	 */
	const SCALE_MODE_BICUBIC_FIXED = IMG_BICUBIC_FIXED;

	/**
	 * @var int 'BLACKMAN' scale mode
	 */
	const SCALE_MODE_BLACKMAN = IMG_BLACKMAN;

	/**
	 * @var int 'BOX' scale mode
	 */
	const SCALE_MODE_BOX = IMG_BOX;

	/**
	 * @var int 'BSPLINE' scale mode
	 */
	const SCALE_MODE_BSPLINE = IMG_BSPLINE;

	/**
	 * @var int 'CATMULLROM' scale mode
	 */
	const SCALE_MODE_CATMULLROM = IMG_CATMULLROM;

	/**
	 * @var int 'GAUSSIAN' scale mode
	 */
	const SCALE_MODE_GAUSSIAN = IMG_GAUSSIAN;

	/**
	 * @var int 'GENERALIZED CUBIC' scale mode
	 */
	const SCALE_MODE_GENERALIZED_CUBIC = IMG_GENERALIZED_CUBIC;

	/**
	 * @var int 'HERMITE' scale mode
	 */
	const SCALE_MODE_HERMITE = IMG_HERMITE;

	/**
	 * @var int 'HAMMING' scale mode
	 */
	const SCALE_MODE_HAMMING = IMG_HAMMING;

	/**
	 * @var int 'HANNING' scale mode
	 */
	const SCALE_MODE_HANNING = IMG_HANNING;

	/**
	 * @var int 'MITCHELL' scale mode
	 */
	const SCALE_MODE_MITCHELL = IMG_MITCHELL;

	/**
	 * @var int 'POWER' scale mode
	 */
	const SCALE_MODE_POWER = IMG_POWER;

	/**
	 * @var int 'QUADRATIC' scale mode
	 */
	const SCALE_MODE_QUADRATIC = IMG_QUADRATIC;

	/**
	 * @var int 'SINC' scale mode
	 */
	const SCALE_MODE_SINC = IMG_SINC;

	/**
	 * @var int 'NEAREST NEIGHBOUR' scale mode
	 */
	const SCALE_MODE_NEAREST_NEIGHBOUR = IMG_NEAREST_NEIGHBOUR;

	/**
	 * @var int 'WEIGHTED4' scale mode
	 */
	const SCALE_MODE_WEIGHTED4 = IMG_WEIGHTED4;

	/**
	 * @var int 'TRIANGLE' scale mode
	 */
	const SCALE_MODE_TRIANGLE = IMG_TRIANGLE; 
	
	/**
	 * @var resource Image resource
	 */
	protected $imageResource;
	
	/**
	 * Image class constructor
	 * 
	 * @param int $width Image width in pixels
	 * @param int $height Image height in pixels
	 */
	public function __construct(int $width, int $height) {
		$this->imageResource = imagecreate($width, $height);
	}
	
	/**
	 * Create object from image data
	 * 
	 * @param string $data Image data
	 * @return $this
	 */
	public static function createFromStream(string $data) {
		$instance = new self(1, 1);
		$instance->imageResource = imagecreatefromstring($data);
		return $instance;
	}
	
	/**
	 * Create Image object from image file
	 * 
	 * @param string $filename Filename
	 * @return $this
	 */
	public static function createFromFile(string $filename) {
		$data = file_get_contents($filename);
		return self::createFromStream($data);
	}
	
	/**
	 * Export Image object to stream
	 * 
	 * @param string $mimeType MIME type
	 * @param int $compression Image compression, if available for the current filetype (between 0 and 100 percent, default: 0).
	 * @return string Image data
	 */
	public function getStreamAs(string $mimeType, int $compression = 0) {
		$exportMethod = 'image'.explode('/', $mimeType)[1];
		ob_start();
		if ($mimeType == self::MIME_TYPE_JPEG) {
			$compression = round((1 - ($compression / 100)) * 100, 0);
			$exportMethod($this->imageResource, NULL, $compression);
		} elseif ($mimeType == self::MIME_TYPE_PNG) {
			$compression = round(($compression / 100) * 9, 0);
			$exportMethod($this->imageResource, NULL, $compression);
		} else {
			$exportMethod($this->imageResource);
		}
		return ob_get_clean();
	}
	
	/**
	 * Export Image object to file
	 * 
	 * @param string $filename Filename
	 * @param string $mimeType MIME type
	 * @param int $compression Image compression, if available for the current filetype (between 0 and 100 percent, default: 0).
	 * @return bool Return TRUE, if successful. Otherwise FALSE.
	 */
	public function saveToFileAs(string $filename, string $mimeType, int $compression = 0) {
		$data = $this->getStreamAs($mimeType, $compression);
		if (file_put_contents($filename, $data) === FALSE) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	/**
	 * Scale image
	 * 
	 * @param int $width Width
	 * @param int $height Height
	 * @param int $mode Scaling algorithm
	 * @return bool Returns TRUE, if successful. Otherwise FALSE.
	 */
	public function scale(int $width, int $height, int $mode = Image::SCALE_MODE_BILINEAR_FIXED) {
		$result = imagescale($this->imageResource, $width, $height, $mode);
		if ($result === FALSE) {
			return FALSE;
		} else {
			$this->imageResource = $result;
			return TRUE;
		}
	}
	
	/**
	 * Rotate image
	 * 
	 * @param float $angle Rotation angle (in degrees)
	 * @param int $bgColorRedChannel (between 0 and 255, default: 0)
	 * @param int $bgColorGreenChannel (between 0 and 255, default: 0)
	 * @param int $bgColorBlueChannel (between 0 and 255, default: 0)
	 * @param int $bgColorAlphaChannel (between 0 = completely opaque and 127 = completely transparent, default: 127)
	 */
	public function rotate(float $angle, int $bgColorRedChannel = 0 , int $bgColorGreenChannel = 0, int $bgColorBlueChannel = 0, int $bgColorAlphaChannel = 127) {
		$bgColor = imagecolorallocatealpha($this->imageResource, $bgColorRedChannel, $bgColorGreenChannel, $bgColorBlueChannel, $bgColorAlphaChannel);
		if ($bgColor === FALSE) {
			return FALSE;
		} else {
			$result = imagerotate($this->imageResource, $angle, $bgColor);
			if ($result === FALSE) {
				return FALSE;
			} else {
				$this->imageResource = $result;
				return TRUE;
			}
		}
	}
}
?>
