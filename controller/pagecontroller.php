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
use \OCA\TreeBookmarks\Http\ImageResponse;

class PageController extends Controller {


  private $userId;
  private $urlgenerator;
  private $icon;
  
  public function __construct($AppName, IRequest $request, $UserId, $urlgenerator,$icon){
    parent::__construct($AppName, $request);
    $this->userId = $UserId;
    $this->urlgenerator = $urlgenerator;
    $this->icon=$icon;
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
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function widget($url="", $title="") {
    $params = ['user' => $this->userId,'title'=>$title,'url'=>$url];
    return new TemplateResponse('treebookmarks', 'widget', $params);  // templates/widget.php
  }
  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function getIcon($domain="") {
    return new ImageResponse($this->icon->getIcon($domain));
    // $this->tst->newFolder('treebookmarks')
    // $this->tst->nodeExists('treebookmarks')
  }
}
