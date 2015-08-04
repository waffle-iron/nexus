$(document).ready(function(){
    set_active_links();
});

function set_active_links(){
    $("a[href]").each(function(){
        if(document.location.href == this.href){
            $(this).addClass("active");
            //TODO THIS MUST GET DONE ON THE SERVER SIDE IF POSSIBLE
        }
    });
}

var nexus = {
  init: function(){
    //todo find all init functions in the nexus object and run them
    nexus.init_mask();
    nexus.init_tables();
    //todo monitor changes and auto run for input type time
    nexus.init_timepickers();
  },
  init_mask: function(){
    nexus.mask = $('.mask'),
    nexus.mask.show = function(){
      $('.mask').show();
      $('body').addClass('blur');
    };
    nexus.mask.hide = function(){
      $('.mask').hide();
      $('body').removeClass('blur');
    };
  },
  init_tables: function(){

    $('table.sortable').each(function(i){
        $(this).find('thead th .fa-sort').each(function(j){
            $(this).click(function(){
              //todo sort here
            })
        });
    });

    $('table').each(function(i){
      this.add_row = function(){
        var template = nexus.find_template(this.id)
        if(template){
          console.debug(template)
          var new_row = $(this).find('tbody').append($(template).find('tr'));
        }
      };
    });
  },
  init_timepickers: function(){
    $('input[type=time].nexus').each(function(i){
        $(this).attr('type','text');
        $(this).timepicker();
    });

  },
  find_template: function(id){
    id = id || null;

    var template = null;

    if(id){
        template = $('#template_'+id) || $('#'+id) || $(id);
    }

    return template;
  }
};

$(document).ready(nexus.init);

//window.history.pushState([], "Title", "/new-url");
