<?php
  style('treebookmarks', 'style');
  style('treebookmarks', 'skin/ui.dynatree');
  script('treebookmarks', 'vendor/dynatree/dist/jquery.dynatree.min');
  script('treebookmarks', 'widget');
?>
<div id="tbm_form" class="fTbm">
  <form class="addTbm">
    <h1 style="display: block; float: left"><?php p($l->t('Add a bookmark')); ?></h1>
    <div style="color: red; clear: both; visibility:hidden">
      <strong>
        <?php p($l->t('This URL is already bookmarked! Overwrite?')); ?>
      </strong>
    </div>
    <fieldset class="tbm_desc">
      <ul>
        <li>
          <input id="title" type="text" name="title" class="title" value="<?php p($_['title']); ?>"
            placeholder="<?php p($l->t('The title of the page')); ?>" />
        </li>
        <li>
          <input id="url" type="text" name="url" class="url_input" value="<?php p($_['url']); ?>"
            placeholder="<?php p($l->t('The address of the page')); ?>" />
        </li>
        <li>
          <div id="browser"></div>
          <input id="childof" type="hidden" name="childof" value="0" />
        </li>
        <li>
          <input id="folder" type="text" name="folder" class="folder_input"
            placeholder="<?php p($l->t('folder name')); ?>" />
        </li>
        <li>
          <input id="addFolder" type="button" value="<?php p($l->t("Add folder")); ?>" />
        </li>
        <li>
          <input id="addBookmark" type="button" class="submit" value="<?php p($l->t("Save")); ?>" />
        </li>
      </ul>
    </fieldset>
  </form>
</div>
