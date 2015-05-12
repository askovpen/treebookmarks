<?php

namespace OCA\TreeBookmarks\Storage;

class IconStorage {

  private $storage;

  public function __construct($storage) {
    $this->storage = $storage;
  }
  public function getIcon($domain) {
    if (!$this->storage->nodeExists('treebookmarks')) {
      $this->storage->newFolder('treebookmarks');
    }
    return $this->getContent($domain);
  }
  private function getContent($domain) {
    if (!$this->storage->nodeExists('/treebookmarks/'.$domain.'.png')) {

        $this->storage->newFile('treebookmarks/'.$domain.'.png');

      $file=$this->storage->get('/treebookmarks/'.$domain.'.png');
      $content=file_get_contents('https://www.google.com/s2/favicons?domain='.$domain);
      $file->putContent($content);
      return $content;
    } else {
      $file=$this->storage->get('/treebookmarks/'.$domain.'.png');
      return $file->getContent();
    }
  }
}

?>