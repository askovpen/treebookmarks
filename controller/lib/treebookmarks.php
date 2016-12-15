<?php
namespace OCA\TreeBookmarks\Controller\Lib;
use OCP\IDb;
class TreeBookmarks {

  public static function makeTree($temp,&$array,$prev=0) {
    foreach ($array as $i=>$k) {
      if ($k['childof']==$prev) {
        if ($k['isFolder']) {
          $arr=array();
          $arr['title']=$k['title'];
          $arr['id']=$k['id'];
          $arr['isFolder']=true;
          $arr['children']=TreeBookmarks::makeTree(array(),$array,$arr['id']);
          array_push($temp,$arr);
        } else {
          $arr=array();
          $arr['title']=$k['title'];
          $arr['id']=$k['id'];
          $arr['href']=$k['url'];
          $arr['icon']=\OC::$server->getURLGenerator()->linkToRoute('treebookmarks.page.get_icon').'?domain='.parse_url($k['url'])['host'];
//          $arr['icon']='https://www.google.com/s2/favicons?domain='.parse_url($k['url'])['host'];
          array_push($temp,$arr);
        }
      }
    }
    return $temp;
  }

  public static function addFolder($userid,$db,$title,$childOf) {
    $sql="insert into `*PREFIX*treebookmarks`(`user_id`,`title`,`childof`,`added`,`isFolder`) values(?,?,?,now(),1)";
    $query = $db->prepareQuery($sql);
    return $query->execute(array($userid,$title,$childOf));
  }

  public static function addBookmark($userid,$db,$title,$url,$childOf) {
    $sql="insert into `*PREFIX*treebookmarks`(`user_id`,`title`,`url`,`childof`,`added`) values(?,?,?,?,now())";
    $query = $db->prepareQuery($sql);
    return $query->execute(array($userid,$title,$url,$childOf));
  }

  public static function moveBookmark($userid,$db,$node,$toNode) {
    $sql="update `*PREFIX*treebookmarks` set `childof`=? where `id`=? and `user_id`=?";
    $query = $db->prepareQuery($sql);
    return $query->execute(array($toNode,$node,$userid));
  }

  public static function delBookmark($userid,$db,$node) {
    $sql="delete from `*PREFIX*treebookmarks` where `id`=? and `user_id`=?";
    $query = $db->prepareQuery($sql);
    $query->execute(array($node,$userid));
    $sql="update `*PREFIX*treebookmarks` set `childof`=0 where `childof`=? and `user_id`=?";
    $query = $db->prepareQuery($sql);
    $query->execute(array($node,$userid));
    return true;
  }

  public static function findBookmarks($userid,$db,$folder=0) {
    $req="";
    if ($folder) {
      $req=" and `isFolder`=1";
    }
    $sql="select * from `*PREFIX*treebookmarks` WHERE `user_id` = ?".$req." order by `title`";
    $query = $db->prepareQuery($sql);
    $a=$query->execute(array($userid))->fetchAll();
    if ($folder) {
      return array('title'=>'root','id'=>'0','isFolder'=>true,'children'=>TreeBookmarks::makeTree(array(),$a));
    } else {
      return TreeBookmarks::makeTree(array(),$a);
    }
  }
}
?>