(function ($, OC) {
  $(document).ready(function () {
    $('#browser').dynatree({
      initAjax: {
        url: OC.generateUrl('/apps/treebookmarks/api/1.0/getFolders')
      },
      onActivate: function(node) {
        $('#childof').val(node.data.id);
      }
    });
    $("#addFolder").click(function() {
        $.ajax({
          type: "POST",
          url: OC.generateUrl('/apps/treebookmarks/api/1.0/addFolder'),
          data: {title: $("#folder").val(), childOf:$('#childof').val()},
          success: function() {
            $('#browser').dynatree("getTree").reload();
          }
        });
    });
    $("#addBookmark").click(function() {
        $.ajax({
          type: "POST",
          url: OC.generateUrl('/apps/treebookmarks/api/1.0/addBookmark'),
          data: {title: $("#title").val(), url:$('#url').val(), childOf:$('#childof').val()},
          success: function() {
            window.close();
          }
        });
    });
  });
})(jQuery, OC);