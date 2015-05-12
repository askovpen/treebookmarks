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

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\TreeBookmarks\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */

namespace OCA\TreeBookmarks\AppInfo;

$application = new Application();
$application->registerRoutes($this, array(
    'routes' => [
     ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
     ['name' => 'page#widget', 'url' => '/widget', 'verb' => 'GET'],
     ['name' => 'page#get_icon', 'url' => '/icon', 'verb' => 'GET'],
     ['name' => 'rest#rest', 'url' => '/api/1.0/{path}', 'verb' => 'GET'],
     ['name' => 'rest#rest2', 'url' => '/api/1.0/{path}', 'verb' => 'POST'],
    ]
));
