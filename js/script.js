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
      initAjax: {
        url: OC.generateUrl('/apps/treebookmarks/bm')
      },
      imagePath:'',
      onActivate: function(node) {
        if( node.data.href ) {
          window.open(node.data.href, node.data.target);
        }
      },
      onPostInit: function(isReloading, isError, XMLHttpRequest, textStatus, errorThrown) {
//        console.table('isReloading: '+isReloading+', isError: '+isError+', XMLHttpRequest: '+XMLHttpRequest+', textStatus: '+textStatus);
//        var node = $("#browser").dynatree("getRoot");
//        console.table(node);
//        node.sortChildren(null, true);
      }
    });
  });
})(jQuery, OC);
