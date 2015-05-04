<?php
namespace OCA\TreeBookmarks\Controller\Lib;
use OCP\IDb;
class TreeBookmarks {
  public static function findBookmarks($userid,$db) {
    $sql="select * from `*PREFIX*treebookmarks` WHERE `user_id` = ?";
    $query = $db->prepareQuery($sql);
    return $query->execute(array($userid))->fetchAll();
  }
  public static function findFolders($userid,$db) {
    $sql="select * from `*PREFIX*treebookmarks_folder` WHERE `user_id` = ?";
    $query = $db->prepareQuery($sql);
    return $query->execute(array($userid))->fetchAll();
  }
}
?>