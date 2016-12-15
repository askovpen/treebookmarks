<?php
script('treebookmarks', 'script.min');
script('treebookmarks', 'vendor/dynatree/dist/jquery.dynatree.min');
style('treebookmarks', 'skin/ui.dynatree.min');
$url=$_['url'];
$widgeturl=widget($url);
function widget($url) {
  $l = \OC::$server->getL10N('treebookmarks');
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
      <div id="trash"><img src="<?php echo \OCP\Util::linkToAbsolute('treebookmarks','img/trash.png') ?>"></div>
      <?php 
        print_unescaped($this->inc('part.content'));
        print_unescaped($widgeturl); 
      ?>
    </div>
  </div>
</div>
