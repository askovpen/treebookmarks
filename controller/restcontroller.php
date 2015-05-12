<?php

namespace OCA\TreeBookmarks\Controller;
use \OCA\TreeBookmarks\Controller\Lib\TreeBookmarks;
use \OCP\AppFramework\Http\DataResponse;
use \OCP\AppFramework\ApiController;
use \OCP\IRequest;
use \OCP\IDb;
use \OC\User\Manager;

class RestController extends ApiController {

  private $db;
  private $userManager;
  private $userId;

  public function __construct($appName, IRequest $request, IDb $db , $userId=null,Manager $userManager=null) {
    parent::__construct($appName, $request);

    $this->db=$db;
    $this->userId=$userId;
    $this->userManager=$userManager;
  }

  /**
  * @CORS
  * @NoAdminRequired
  * @NoCSRFRequired
  * @PublicPage
  */
  public function Rest2($path,$user,$password=null,$title="",$url="",$childOf=0) {
    $this->Rest($path,$user,$password,$title,$url,$childOf);
  }
  /**
  * @CORS
  * @NoAdminRequired
  * @NoCSRFRequired
  * @PublicPage
  */
  public function Rest($path,$user,$password=null,$title="",$url="",$childOf=0) {
    if ($this->userId == null && ($user == null || $this->userManager->userExists($user) == false)) {
      return new DataResponse(array('error' => 'User could not be identified'));
    }
    $public=true;
    if ($this->userId != null) {
      $user=$this->userId;
      $public=false;
    }
    if ($public && !$this->userManager->checkPassword($user, $password)) {
      return new DataResponse(array('error' => 'Wrong password for user '.$user));
    }
    switch ($path) {
      case 'getBookmarks':
        return new DataResponse(TreeBookmarks::findBookmarks($user,$this->db));
        break;
      case 'getFolders':
        return new DataResponse(TreeBookmarks::findBookmarks($user,$this->db,1));
        break;
      case 'addFolder':
        return new DataResponse(TreeBookmarks::addFolder($user,$this->db,$title,$childOf));
        break;
      case 'addBookmark':
        return new DataResponse(TreeBookmarks::addBookmark($user,$this->db,$title,$url,$childOf));
        break;
      default:
        return new DataResponse(array('error' => 'Unknown method '.$path));
    }
    return array($path,$user);
  }
}
?>