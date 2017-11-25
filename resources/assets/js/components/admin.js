
// const $ = require('jquery');



function init() {
	
var $tree = $('#menuTree');
var selectPage;

    $tree.tree({
        autoOpen: true,
        dragAndDrop: true,
        onCreateLi: function(node, $li) {
            // Append a link to the jqtree-element div.
            // The link has an url '#node-[id]' and a data property 'node-id'.
            $li.find('.jqtree-element').append(
                '<span class="page" data-node-id="'+node.id +'">'+node.page.name +' <small>/'+node.page.slug +'</small></span>',
                '<a href="#node-'+ node.id +'" class="edit glyphicon glyphicon-pencil" data-node-id="'+node.id +'"></a>',
            );

        },
    });


/*    var node = $('#menuTree').tree('getNodeById', 2);
    console.log(node);*/
    

    /*$tree.tree(
        'addParentNode',
        {
            name: 'new_parent',
            id: 456
        },
        node1
    );*/

    /*
    $('#menuTree').tree({
    autoOpen: true,
    dragAndDrop: true,
    // saveState: true
    });
    */



   // Handle a click on the edit link
    $tree.on(
        'click', '.edit',
        function(e) {
            // Get the id from the 'node-id' data property
            var node_id = $(e.target).data('node-id');

            // Get the node from the tree
            var node = $tree.tree('getNodeById', node_id);

            if (node) {
                // Display the node name
                console.log(node);
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
          },
          /*data: { test: JSON.stringify({
                  test: 'data123'
                })}, 
                */
                // Our valid JSON string
          /*success: function( data, status, xhr ) {
             console.log(data);
          }*/
        });

/*
        console.log('moved_node', event.move_info.moved_node.id);
        console.log('target_node', event.move_info.target_node.id);
*/

        // console.log('moved_node', event.move_info.moved_node.id);
        // console.log('target_node', event.move_info.target_node.id);
        // console.log('position', event.move_info.position);
        // console.log('previous_parent', event.move_info.previous_parent.id);
    }
	);



$( "#newMenu" ).submit(function( event ) {

    let nameEl = $( "input[type=text][name=name]" );
    let pageEl = $( "input[type=text][name=page]" );
    let pageIdEl = $( "input[type=text][name=page_id]" );
    let slugEl = $( "input[type=text][name=slug]" );

    let name = nameEl.val();
    let page = pageEl.val();
    let page_id = pageIdEl.val();
    let slug = slugEl.val();
        
        
        $.ajax({
          url: "/admin/menu/json/create",
          dataType: "text",
          type: "POST",
          data: {
            name: name,
            page_id: page_id
          },
          success: function( newNode, status, xhr ) {
                //Установка ноды
                $tree.tree('appendNode', {
                                        id: newNode.id,
                                        name: name,
                                        page: {name: page, slug: slug},
                                    });
                //Обновление дерева
                $tree.tree('reload');

                 nameEl.val('');
                 pageEl.val('');
                 pageIdEl.val('');
                 slugEl.val('');

            }
        });
        

  event.preventDefault();
});




/*    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }*/
 
    $( "input[type=text][name=page]" ).autocomplete({
      source: "/page/search",
      minLength: 2,
      select: function( event, ui ) {
        $( "input[type=text][name=page_id]" ).val(ui.item.id);
        $( "input[type=text][name=slug]" ).val(ui.item.slug);
        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
         return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<div>" + item.name + " <small>/" + item.slug + "</small></div>")
             // .append("<small>" + item.slug + "</small>")
             .appendTo(ul);
     };



/*
    $tree.on('click', '.new', function(e) {
    $('#menuTree').tree(
                        'appendNode',
                        {
                            name: 'new_node',
                            page: {title: 'none', slug: 'none'},
                        }
                    );
    });
*/

};

export default init;

