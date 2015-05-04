<?php
script('treebookmarks', 'script');
// script('treebookmarks', 'vendor/jstree/dist/jstree');
script('treebookmarks', 'vendor/dynatree/dist/jquery.dynatree');
//style('treebookmarks', 'style');
style('treebookmarks', 'skin/ui.dynatree');
?>

<div id="app">
  <div id="app-content">
    <div id="app-content-wrapper">
      <?php print_unescaped($this->inc('part.content')); ?>
    </div>
  </div>
</div>
