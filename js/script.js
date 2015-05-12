/**
 * ownCloud - treebookmarks
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Alexander N. Skovpen <a.n.skovpen@gmail.com>
 * @copyright Alexander N. Skovpen 2015
 */

(function ($, OC) {
  $(document).ready(function () {
    $('#browser').dynatree({
      dnd: {
        onDragStart: function(node) {
          return true;
        },
        onDragEnter: function(node, sourceNode) {
          if (node.data.isFolder===false) {
            return false;
          }
          return ['over'];
        },
        onDrop: function(node, sourceNode, hitMode, ui, draggable) {
          $.ajax({
            type: "POST",
            url: OC.generateUrl('/apps/treebookmarks/api/1.0/moveBookmark'),
            data: { node:sourceNode.data.id, toNode:node.data.id },
            success: function() {
              sourceNode.move(node, hitMode);
            }
          });
//          console.table([node.data.id,sourceNode.data.id]);
        }
      },
      initAjax: {
        url: OC.generateUrl('/apps/treebookmarks/api/1.0/getBookmarks')
      },
      imagePath:'',
      onActivate: function(node) {
        if( node.data.href ) {
          window.open(node.data.href, node.data.target);
        }
      },
    });
    $('#trash').droppable({
      drop: function(event, ui) {
        console.table(ui.helper.data("dtSourceNode").data.id);
        var source=ui.helper.data("dtSourceNode");
        $.ajax({
          type: "POST",
          url: OC.generateUrl('/apps/treebookmarks/api/1.0/delBookmark'),
          data: { node:ui.helper.data("dtSourceNode").data.id },
          success: function() {
            source.remove();
          }
        });
      }

    });
  });
})(jQuery, OC);
