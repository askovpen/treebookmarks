<?php
/**
 * ownCloud - galleryplus
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Olivier Paroz <owncloud@interfasys.ch>
 *
 * @copyright Olivier Paroz 2014-2015
 */

namespace OCA\TreeBookmarks\Http;

use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Http;

/**
 * A renderer for images
 *
 * @package OCA\GalleryPlus\Http
 */
class ImageResponse extends Response {

	/**
	 * @var string
	 */
	private $data;
	/**
	 * @var \OC_Image|string
	 */

	/**
	 * Constructor
	 *
	 * @param array $image image meta data
	 * @param int $statusCode the HTTP status code, defaults to 200
	 */
	public function __construct($content, $statusCode = Http::STATUS_OK) {
		$this->data = $content;
		$this->setStatus($statusCode);
		$this->addHeader('Content-type', 'image/png' . '; charset=utf-8');

//		\OCP\Response::setContentDispositionHeader(basename($this->path), 'attachment');
	}
  public function render() {
    return $this->data;
  }

}
