
// const $ = require('jquery');


function init() {
    if($('#menuTree').length) { init_admin_menu(); }
    if($('#relations').length) { init_admin_relations(); }
    if($('#upload_images').length) { init_images(); }
    if($('.ajax').length) { init_inputChange(); }
    $(".btn-danger").click(function() { if(!confirm('Вы уверены?')) { return false; }});

    init_panel_collapsed();
}




function humanFileSize(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
        ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
}



function init_images() {

var types = null; 

  function getImages(response) {
    types = response.types;
    $.each(response.images, function(id, data) {
        createImage(id, data);
    });
  }

function sendImage(data) {
    data.page = $("#id").val();
            $.ajax({
              url: "/admin/image/json",
              dataType: "json",
              type: "POST",
              data: data
            });
}

$('#images_list').on('keypress', 'input:text', function(e){
  if (e.keyCode == 13) {
    $(this).blur();
    return true;
  }
});

$('#images_list').on('change', 'input:text', function(){
    let data = $(this).val();
    let type = $(this).attr('name');
    let id = $(this).parents('.imagefile').attr('id');
    sendImage({action:'change', image:id, type:type, data:data});
});

$('#images_list').on('click', 'input:checkbox', function(){
    let data = $(this).is(':checked');
    let type = $(this).val();
    let id = $(this).parents('.imagefile').attr('id');
    sendImage({action:'type', image:id, type:type, data:data});
});

$('#images_list').on('click', '#deleteImage', function(){
    if(!confirm('Удалить изображение?')) { return false; }
    let id = $(this).parents('.imagefile').attr('id');
    $(this).parents('.imagefile').remove();
    sendImage({action:'delete', image:id});
    return false;
});

$('#images_list').on('click', '#deleteErrorImage', function(){
    let id = $(this).parents('.imagefile').attr('id');
    $(this).parents('.imagefile').remove();
    return false;
});

  function createImage(id, data) {
    const images_list = $('#images_list');
    // console.log(data.filename.length);
    // if(data.filename.length) {
       const src = '/images/small/'+data.filename;
       const link = '/images/full/'+data.filename;
    // } else {
     // const src = '/images/icon/no_preview.jpg';
    // }
    const title = data.title;
    const alt = data.alt;
    const size = data.filesize;

            //Новый элемент
            let imageDiv = $("<div></div>").attr("id", id).addClass('imagefile row');
            let thumbnailDiv = $('<div>').addClass('col-xs-2').appendTo(imageDiv);
            let imgHref = $('<a>').attr('href', link).attr('target', '_blank').appendTo(thumbnailDiv);
            $('<img>').attr('src', src).addClass('img-thumbnail').appendTo(imgHref);

             let info = $('<div>').addClass('info col-xs-5').appendTo(imageDiv);
             let info2 = $('<div>').addClass('info col-xs-5 form-inline').appendTo(imageDiv);

            let titleDiv = $('<div>').addClass('form-group').appendTo(info);
              let titleInput = $('<input>').attr('name', 'title').val(title).attr('placeholder', 'Title').addClass('form-control input-sm').appendTo(titleDiv);

            let AltDiv = $('<div>').addClass('form-group').appendTo(info);
              let altInput = $('<input>').attr('name', 'alt').val(alt).attr('placeholder', 'Alt').addClass('form-control input-sm').appendTo(AltDiv);

            let typeDiv = $('<div>').addClass('form-group').appendTo(info2);

            $.each(types, function(i, type) {
                  let typeCheckbox = $('<input />', { name: 'type', type: 'checkbox', id: 'cb'+type.id+id, value: type.id });
                  typeCheckbox.appendTo(typeDiv);
                  $('<label />', { 'for': 'cb'+type.id+id, text: type.title }).appendTo(typeDiv);

                  $.each(data.imagetypes, function(x, imagetype) {
                     if(type.id == imagetype.id) { 
                      typeCheckbox.attr('checked',true);
                     }
                  });
            });

             $('<div>').html('Размер файла: '+humanFileSize(size,false)).appendTo(info2);
             $('<button>').addClass('btn btn-xs').attr('id', 'deleteImage').text('Удалить').appendTo(info2);

            images_list.append(imageDiv);

  }


const page = $("#id").val();

            $.ajax({
              url: "/admin/image/json",
              dataType: "json",
              type: "POST",
              data: {
                action: 'get',
                page: page
              },
              success: getImages
            });


    $('#upload_images:file').on('change', function() {
    
          $.each($("#upload_images:file")[0].files, function(i, file) {

            //Новый временный ID
           let new_file_id = Date.now() * file.size;

            //Новый элемент
            var newfile = $("<div></div>");
            newfile.attr("id", new_file_id);
            newfile.addClass('imagefile row');
            $('#images_list').append(newfile);

            var thumbnail = $('<div>').addClass('col-xs-2').appendTo(newfile);

            //Читаем файл для предпросмотра
            var reader = new FileReader();
            reader.onload = function(e) {

                var img = $('<img>');
                if (file.size < 1024*2*1024) { img.attr('src', e.target.result); } else { img.attr('src', '/images/icon/no_preview.jpg'); }
                img.addClass('img-thumbnail');
                img.appendTo(thumbnail);
              

             var info = $('<div>').addClass('info col-xs-10').appendTo(newfile);
             $('<progress>').appendTo(info);
             $('<div>').html('Название файла: '+file.name).appendTo(info);
             $('<div>').html('Размер файла: '+humanFileSize(file.size,false)).appendTo(info);
             
            }

            reader.readAsDataURL(file);

              var data = new FormData();

              data.append('file', file);
              data.append('page', $("#id").val());
              data.append('file_name', file.name);

              $.ajax({
  
              xhr: function()
              {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    $('#'+new_file_id+' progress').val(percentComplete);
                    if(percentComplete == 1) { $('#'+new_file_id+' progress').remove(); }
                  }
                }, false);

                //Download progress
                xhr.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    $('#'+new_file_id+' progress').val(percentComplete);
                    if(percentComplete == 1) { $('#'+new_file_id+' progress').remove(); }
                  }
                }, false);
                return xhr;
                
              },
                  type: 'POST',
                  url: '/admin/image/upload',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data : data,
                  success: function(result){
                      $('#'+new_file_id).remove();
                      createImage(result.id, result.data);
                  },
                  error: function(err){
                      var info = $('#'+new_file_id+' .info');
                      $('#'+new_file_id+' progress').remove();
                      info.parent().addClass('alert-danger');

                      $('<div>').addClass('status').html('<strong>'+err.status+': '+err.statusText+'</strong>').prependTo(info);
                      $('<button>').addClass('btn btn-xs').attr('id', 'deleteErrorImage').text('Удалить').appendTo(info);
                  }
              });

          });

        $(this).val('');

    });

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
//------Menu End: jqTree & lazychaser/laravel-nestedset------



//------Автозаполнение / поиск страницы Start: для page_relations------
function init_admin_relations() {


function set_relations(type, to_id) {

    /*
    if(!$('#relationsList ul li[data-to-id="'+idEl.val()+'"]').length) {
    console.log(true);
    } else {
    console.log(false);
    }
    */
                var set_data = {
                  page_id: idEl.val(),
                  to_id: to_id,
                  type: type
                }
                $.ajax({
                  url: "/admin/page/json",
                  type: "POST",
                  data: set_data
                });

       // $('#relationsList ul li[data-to-id="'+to_id+'"]').css('background', '#fff000');
       checkLabelDisplay();
}

function deleteRef() {
    if (confirm("Вы подтверждаете удаление вложенности?")) {
      set_relations('delete', $(this).attr("data-to-id"));
      $(this).remove();
      checkLabelDisplay();
    }
}

function checkLabelDisplay() {
  if($('#relationsList ul li').length) {
    $('#relationsList label').css('display', 'block');
  } else {
    $('#relationsList label').css('display', 'none');
  }
}

checkLabelDisplay();

    const idEl = $( "input[type=hidden][name=id]" );
    if(!idEl.length) {
        $('#relations').css('display', 'none');
    }



$( "#relationsList ul li" ).dblclick(deleteRef);

      $( "#relations" ).autocomplete({
        source: "/page/search",
        minLength: 2,
        select: function( event, ui ) {

          if(!$('#relationsList ul li[data-to-id="'+ui.item.id+'"]').length) {
            // return $("#relationsList ul").append('<li data-to-id="'+ui.item.id+'">'+ui.item.name+' <small>/'+ui.item.slug+'</small></li>').dblclick(deleteRef);
            
            $("#relationsList ul").append(function() {
              return $('<li data-to-id="'+ui.item.id+'">'+ui.item.name+' <small>/'+ui.item.slug+'</small></li>').dblclick(deleteRef);
            });

              $(this).val("");
              set_relations('create', ui.item.id);
          } else { alert('Уже подключено...'); }
            return false;
        }
      }).data("ui-autocomplete")._renderItem = function (ul, item) {
           return $("<li></li>")
               .data("item.autocomplete", item.id)
               .append("<div>" + item.name + " <small>/" + item.slug + "</small></div>")
               .appendTo(ul);
       };

}
//------Автозаполнение / поиск страницы End: для page_relations------




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


  // image_list: []
/*  image_list: [
    {title: 'My image 1', value: 'https://www.tinymce.com/images/img-404@2x.png'},
    {title: 'My image 2', value: 'https://ae01.alicdn.com/kf/HTB1qRfuSFXXXXXCXXXXq6xXFXXXC/lovely-ice-trees-lake-snow-track-winter-season-nature-landscape-KC466-Living-room-home-wall-art.jpg'}
  ],*/

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




function init_inputChange() {

    $('.ajax').on('change', 'input:text', function(){
      send_inputChange({
        'id':$(this).attr('id'),
        'name':$(this).attr('name'),
        'value':$(this).val(),
        'fieldType':$(this).attr('fieldType'),
      }, $(this).attr('route'));
    });

    function send_inputChange(data, route) {
                  $.ajax({
                    url: route,
                    dataType: "json",
                    type: "POST",
                    data: data,
                    success: response_inputChange
                  });
    }

  function response_inputChange(response) {

    var obj = $( "input[id='"+response.id+"'][name$='"+response.name+"']" );
    obj.val(response.value);
    obj.fadeTo( "fast", '0.5' );
    obj.fadeTo( "fast", '1.0' );

    //.delay(800).css("background-color","red");
    //$("#id input[name='"+response.name+"']")
    //console.log(res);
    /*types = response.types;
    $.each(response.images, function(id, data) {
        createImage(id, data);
    });*/
  }

}

export default init;

