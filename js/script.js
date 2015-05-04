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
  var app= {
    bm: [],
    folders: [],
    result: [],
    init: function() {
      var self=this;
      var url = OC.generateUrl('/apps/treebookmarks/bm');
      $.getJSON(url,function(data) {
        self.bm=data;
        var url = OC.generateUrl('/apps/treebookmarks/folders');
        $.getJSON(url,function(data) {
          self.folders=data;
          self.makeTree();
        });
      });
    },
    makeTree: function() {
      this.result=this.makeTreeFolder(this.folders.concat(this.bm));
//      console.table(this.result);
      this.draw();
    },
    makeTreeFolder: function(array,parent,tree) {
      var self=this;
      tree = typeof tree !== 'undefined' ? tree : [];
      parent = typeof parent !== 'undefined' ? parent : { id: 0 };
      var children = _.filter( array, function(child){ return child.childof == parent.id && parent.url==undefined; });
      if (!_.isEmpty(children)) {
        if (parent.id == 0) {
          tree = children;
        } else {
          parent['children'] = children;
        }
        _.each( children, function( child ){ self.makeTreeFolder( array, child ) } );
      }

      return tree;
    },
    draw: function(part) {
      if (part) {
        var html=$('<ul>');
        for (var i in part) {
          var li;
          if ("name" in part[i]) {
            li=$('<li>').attr('data','{"isFolder":true}').html(part[i].name);
          } else if ("url" in part[i]) {
            var hostname = $('<a>').prop('href', part[i].url).prop('hostname');
//            li=$('<li/>').attr('data-jstree','{"icon":"https://skovpen.org/favicon/cache/'+hostname+'.png"}').html('<a href="'+part[i].url+'" target=_blank>'+part[i].title+'</a>');
            li=$('<li/>').attr('data','{"icon":"https://skovpen.org/favicon/cache/'+hostname+'.png","href":"'+part[i].url+'","target":"_blank"}').html(part[i].title);
          }
          if ("children" in part[i]) {
            li.append(this.draw(part[i].children));
          }
          html.append(li);
        }
        return html;
      } else {
        var html=$('<ul>');
        console.table(this.result);
        for (var i in this.result) {
          var li=($('<li>').attr('data','{"isFolder":true}').html(this.result[i].name));
          if ("children" in this.result[i]) {
            li.append(this.draw(this.result[i].children));
          }
          html.append(li);
        };
        $('#browser').append($(html));
//        $('#browser').jstree({"plugins": ["types","sort"]}).on("activate_node.jstree", function(e,data){
//          if (data.node.a_attr.href!='#')
//            window.open(data.node.a_attr.href,"_blank");
//        });
        $('#browser').dynatree({
          imagePath:'',
          onActivate: function(node) {
            if( node.data.href ) {
              window.open(node.data.href, node.data.target);
            }
          }
        });
      }
    }
  };
  $(document).ready(function () {
    app.init();
	});

})(jQuery, OC);
