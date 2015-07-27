$(document).ready(function(){
    set_active_links();
});

function set_active_links(){
    $("a[href]").each(function(){
        if(document.location.href == this.href){
            $(this).addClass("active");
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
    $('table.nexus').each(function(i){
        var current_table = this;
        $(this).find('thead th .fa-sort').each(function(j){
            $(this).click(function(){
              console.debug(current_table);
            })
        });
      }
    );
  },
  init_timepickers: function(){

    $('input[type=time].nexus').each(function(i){
        $(this).attr('type','text');
        $(this).timepicker();
    });

  }
};

$(document).ready(nexus.init);

//window.history.pushState([], "Title", "/new-url");
