//auto initializing function
$(function() {
    //https://css-tricks.com/snippets/jquery/smooth-scrolling/
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });



});


//template specific
var nexus = nexus || {};
nexus.template = {
  init: function(){
    $(nexus.template.mask.selector).click(function(){
      nexus.template.menu.toggle();
    });

    $("[data-toggle]").click(function(){
      $($(this).attr("data-toggle")).toggleClass("active");
    });

    //check if chosen is installed
    if($.fn.chosen){
      $(".chosen-select").chosen();
    }
  },
  mask:{
    selector:"#mask",
    show:function(){
      $(nexus.template.mask.selector).addClass("active");
    },
    hide:function(){
      $(nexus.template.mask.selector).removeClass("active");
    },
  },
  menu: {
    selector: "#main_menu",
    toggle: function(){
      if($(nexus.template.menu.selector).hasClass("active")){
        nexus.template.menu.hide();
        nexus.template.mask.hide();
      }else{
        nexus.template.menu.show();
        nexus.template.mask.show();
      }

    },
    show: function(){
      $(nexus.template.menu.selector).addClass("active");
      $(nexus.template.menu.toggle_button_selector).addClass("active");
    },
    hide: function(){
        $(nexus.template.menu.selector).removeClass("active");
    }
  }
}

$(function(){
  nexus.template.init();
});
