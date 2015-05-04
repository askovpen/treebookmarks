<?php
script('treebookmarks', 'script');
// script('treebookmarks', 'vendor/jstree/dist/jstree');
script('treebookmarks', 'vendor/dynatree/dist/jquery.dynatree');
//style('treebookmarks', 'style');
style('treebookmarks', 'skin/ui.dynatree');
$url=$_['url'];
$widgeturl=widget($url);
function widget($url) {
  $l = new OC_l10n('bookmarks');
  $w="javascript:(function(){var a=window,b=document,c=encodeURIComponent,e=c(document.title),d=a.open('";
  $w.=$url;
  $w.="?output=popup&url='+c(b.location)+'&title='+e,'bkmk_popup','left='+((a.screenX||a.screenLeft)+10)+',";
  $w.="top='+((a.screenY||a.screenTop)+10)+',height=400px,width=550px,resizable=1,alwaysRaised=1');a.setTimeout(function(){d.focus()},300);})();";
  return '<a href="'.$w.'" target="_new">'.$l->t('Bookmark link').'</a><br><a href="'.$url.'" target="_new">'.$l->t('Bookmark add').'</a>';
}
?>

<div id="app">
  <div id="app-content">
    <div id="app-content-wrapper">
      <?php 
        print_unescaped($this->inc('part.content'));
        print_unescaped($widgeturl); 
      ?>
    </div>
  </div>
</div>
