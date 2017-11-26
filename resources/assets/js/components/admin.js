
// const $ = require('jquery');

function init() {
    if($('#menuTree').length) { init_admin_menu(); }

    init_panel_collapsed();
}


//------Menu Start: jqTree & lazychaser/laravel-nestedset------
function init_admin_menu() {
    
      var $tree = $('#menuTree');
      let idEl = $( "input[type=hidden][name=id]" );
      let nameEl = $( "input[type=text][name=name]" );
      let pageEl = $( "input[type=text][name=page]" );
      let pageIdEl = $( "input[type=hidden][name=page_id]" );
      let slugEl = $( "input[type=hidden][name=slug]" );
      let unpageEl = $( "button[type=button][name=unpage]" );

     unpageEl.on('click', function () {
        pageEl.val('');
        pageIdEl.val('');
        slugEl.val('');
      });

      $tree.tree({
          autoOpen: true,
          saveState: true,
          dragAndDrop: true,
          onCreateLi: function(node, $li) {
                  if(node.page === null) {
                      $li.find('.jqtree-element').append(
                          '<a href="#node-'+ node.id +'" class="edit glyphicon glyphicon-pencil" data-node-id="'+node.id +'"></a>',
                      );
                  } else {
                      $li.find('.jqtree-element').append(
                          '<span class="page" data-node-id="'+node.id +'">'+node.page.name +' <small>/'+node.page.slug +'</small></span>',
                          '<a href="#node-'+ node.id +'" class="edit glyphicon glyphicon-pencil" data-node-id="'+node.id +'"></a>',
                      );
                  }
          }
      });


    $tree.bind(
        'tree.dblclick',
        function(e) {
            if (confirm("Вы подтверждаете удаление?\n\nВнимание!!!\n\nПри удалении родительского меню - удаляться все вложенные меню!")) {

                $.ajax({
                  url: "/admin/menu/json/delete",
                  dataType: "text",
                  type: "DELETE",
                  data: {
                    id: e.node.id
                  },
                  success: function( deleteNodeId, status, xhr ) {
                        if(deleteNodeId == e.node.id) {
                            $tree.tree('removeNode', e.node);
                        }
                    }
                });
            }
        }
    );

     // Handle a click on the edit link
      $tree.on(
          'click', '.edit',
          function(e) {
              var node_id = $(e.target).data('node-id');

              var node = $tree.tree('getNodeById', node_id);

              if (node) {
                   idEl.val(node.id);
                   nameEl.val(node.name);
                   pageEl.val(node.page.name);
                   pageIdEl.val(node.page.id);
                   slugEl.val(node.page.slug);

              }
          }
      );

      $tree.bind('tree.move',
      function(event) {
          $.ajax({
            url: "/admin/menu/json",
            dataType: "text",
            type: "POST",
            data: {
              moved: event.move_info.moved_node.id,
              target: event.move_info.target_node.id,
              position: event.move_info.position
            }
          });
      }
    );

    //Сохранить / обновить
    $( "#newMenu" ).submit(function( event ) {

        let id = idEl.val();
        let name = nameEl.val();
        let page = pageEl.val();
        let page_id = pageIdEl.val();
        let slug = slugEl.val();
            
            
            $.ajax({
              url: "/admin/menu/json/create",
              dataType: "text",
              type: "POST",
              data: {
                id: id,
                name: name,
                page_id: page_id
              },
              success: function( newNode, status, xhr ) {
                    $tree.tree('reload');
                     idEl.val('');
                     nameEl.val('');
                     pageEl.val('');
                     pageIdEl.val('');
                     slugEl.val('');
                }
            });
      event.preventDefault();
    });
    
    //Автозаполнение / поиск страницы
      $( "input[type=text][name=page]" ).autocomplete({
        source: "/page/search",
        minLength: 2,
        select: function( event, ui ) {
          pageIdEl.val(ui.item.id);
          slugEl.val(ui.item.slug);
        }
      }).data("ui-autocomplete")._renderItem = function (ul, item) {
           return $("<li></li>")
               .data("item.autocomplete", item)
               .append("<div>" + item.name + " <small>/" + item.slug + "</small></div>")
               .appendTo(ul);
       };

}
//------Menu Start: jqTree & lazychaser/laravel-nestedset------



//------Tinymce Start------
import tinymce from 'tinymce/tinymce'
import 'tinymce/themes/modern/theme'

// Plugins
import 'tinymce/plugins/paste/plugin'
import 'tinymce/plugins/link/plugin'
import 'tinymce/plugins/image/plugin'
import 'tinymce/plugins/code/plugin'
import 'tinymce/plugins/fullscreen/plugin'
// import 'tinymce/plugins/imagetools/plugin'

// Initialize
tinymce.init({
  selector: '#tinymce',
  skin: false,
  content_style: "* { font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif }",
  // skin_url:  ('/js/tinymce/skins/lightgray/'),
  plugins: "paste link image code fullscreen",
  height : "380",
  image_list: [
    {title: 'My image 1', value: 'https://www.tinymce.com/images/img-404@2x.png'},
    {title: 'My image 2', value: 'https://ae01.alicdn.com/kf/HTB1qRfuSFXXXXXCXXXXq6xXFXXXC/lovely-ice-trees-lake-snow-track-winter-season-nature-landscape-KC466-Living-room-home-wall-art.jpg'}
  ],

  // themes: "modern",
  // content_css: ['//fonts.googleapis.com/css?family=Indie+Flower'],
  // font_formats: 'Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;',
  // menubar: "insert",
  // toolbar: "image",

  // font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',

  // skin: false
})
//------Tinymce End------


 // $('.panel-heading').bind('click', '.clickable', function(e) {



function init_panel_collapsed() {

  $( ".panel-heading" ).click(function() {
      var $this = $(this);
      if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
      } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
      }
  });
}


export default init;

