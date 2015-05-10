<?php
/**
 * ownCloud - treebookmarks
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Alexander N. Skovpen <a.n.skovpen@gmail.com>
 * @copyright Alexander N. Skovpen 2015
 */

namespace OCA\TreeBookmarks\Controller;

use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Http\DataResponse;
use \OCP\AppFramework\Controller;
use \OCP\IDb;
use \OCA\TreeBookmarks\Controller\Lib\TreeBookmarks;

class PageController extends Controller {


	private $userId;
	private $db;
	private $urlgenerator;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
    $this->db = \OC::$server->getDb();
    $this->urlgenerator = \OC::$server->getURLGenerator();
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
    $widgeturl=$this->urlgenerator->linkToRoute('treebookmarks.page.widget');
		$params = ['user' => $this->userId, 'url'=>$widgeturl];
		return new TemplateResponse('treebookmarks', 'main', $params);  // templates/main.php
	}

  /**
   * Simply method that posts back the payload of the request
   * @NoAdminRequired
   */
  public function getBookmarks($isFolder=0) {
    $bookmarks=TreeBookmarks::findBookmarks($this->userId,$this->db,$isFolder);
    return new DataResponse($bookmarks);
  }
  /**
   * Simply method that posts back the payload of the request
   * @NoAdminRequired
   */
  public function addFolder($title="",$childOf=0) {
    $bookmarks=TreeBookmarks::addFolder($this->userId,$this->db,$title,$childOf);
    return new DataResponse($bookmarks);
  }
  /**
   * Simply method that posts back the payload of the request
   * @NoAdminRequired
   */
  public function addBookmark($title="",$url="",$childOf=0) {
    $bookmarks=TreeBookmarks::addBookmark($this->userId,$this->db,$title,$url,$childOf);
    return new DataResponse($bookmarks);
  }
  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function widget($url="", $title="") {
    $params = ['user' => $this->userId,'title'=>$title,'url'=>$url];
    return new TemplateResponse('treebookmarks', 'widget', $params);  // templates/widget.php
  }
}
