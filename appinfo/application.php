<?php

namespace OCA\TreeBookmarks\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\IAppContainer;

use OCA\TreeBookmarks\Controller\PageController;
use OCA\TreeBookmarks\Controller\RestController;
use OCA\TreeBookmarks\Storage\IconStorage;

class Application extends App {

  public function __construct(array $urlParams=array()) {
    parent::__construct('treebookmarks', $urlParams);

    $container = $this->getContainer();
    $container->registerService('PageController', function($c) {
      return new PageController(
        $c->query('AppName'),
        $c->query('Request'),
        $c->query('UserId'),
        $c->query('ServerContainer')->getURLGenerator(),
        $c->query('IconStorage')
      );
    });
    $container->registerService('RestController', function($c) {
      return new RestController(
        $c->query('AppName'),
        $c->query('Request'),
        $c->query('ServerContainer')->getDb(),
        $c->query('UserId'),
        $c->query('ServerContainer')->getUserManager()
      );
    });
    $container->registerService('IconStorage', function($c) {
      return new IconStorage($c->query('ServerContainer')->getAppFolder());
    });
  }
}
?>