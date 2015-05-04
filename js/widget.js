(function ($, OC) {
  $(document).ready(function () {
    console.table('test');
    $('#browser').dynatree({
      initAjax: {
        url: OC.generateUrl('/apps/treebookmarks/bm?isFolder=1')
      },
      onActivate: function(node) {
        $('#childof').val(node.data.id);
      }
    });
    $("#addFolder").click(function() {
        $.ajax({
          type: "POST",
          url: OC.generateUrl('/apps/treebookmarks/add_folder'),
          data: {title: $("#folder").val(), childOf:$('#childof').val()},
          success: function() {
            $('#browser').dynatree("getTree").reload();
          }
        });
    });
    $("#addBookmark").click(function() {
        $.ajax({
          type: "POST",
          url: OC.generateUrl('/apps/treebookmarks/add_bookmark'),
          data: {title: $("#title").val(), url:$('#url').val(), childOf:$('#childof').val()},
          success: function() {
            window.close();
          }
        });
    });
  });
})(jQuery, OC);