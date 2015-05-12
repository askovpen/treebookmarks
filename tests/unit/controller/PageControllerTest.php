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
use \OCA\TreeBookmarks\Controller\Lib\TreeBookmarks;
use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\TemplateResponse;

class PageControllerTest extends PHPUnit_Framework_TestCase {

  private $controller;
  private $userId = 'test';
  private $db;

  public function setUp() {
    $request = $this->getMockBuilder('OCP\IRequest')->getMock();
    $this->db = \OC::$server->getDb();
    $this->urlgenerator = \OC::$server->getURLGenerator();
    $this->controller = new PageController(
      'treebookmarks', $request, $this->userId,$this->urlgenerator
    );
  }

  public function testIndex() {
    $result = $this->controller->index();

    $this->assertEquals(['user' => 'test','url' => '/index.php/apps/treebookmarks/widget'], $result->getParams());
    $this->assertEquals('main', $result->getTemplateName());
    $this->assertTrue($result instanceof TemplateResponse);
  }
  public function testFolder() {
    $this->assertEquals(TreeBookmarks::addFolder($this->userId,$this->db,'test',0),true);
  }
  public function testBookmark() {
    $this->assertEquals(TreeBookmarks::addBookmark($this->userId,$this->db,'test','http://test',0),true);
    $this->cleanDB();
  }
  function cleanDB() {
    $query = $this->db->prepareQuery("DELETE FROM *PREFIX*treebookmarks where title='test'");
    $query->execute();
  }
}