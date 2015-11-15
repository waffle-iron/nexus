String.prototype.replaceAll = function(f,r){return this.split(f).join(r);}
String.prototype.parse_color = function(){
    //CREDIT http://www.javascripter.net/faq/rgbtohex.htm
    var color = this.replaceAll(" ", "");
    var converted_color = "Invalid Input";

    function toHex(n) {
     n = parseInt(n,10);
     if (isNaN(n)) return "00";
     n = Math.max(0,Math.min(n,255));
     return "0123456789ABCDEF".charAt((n-n%16)/16)
          + "0123456789ABCDEF".charAt(n%16);
    }

    if(color.indexOf("rgb(") === 0 && color.length <= 16 && color.length >= 10 && color.indexOf(")") == color.length -1){
        color = color.replace("rgb(","").replace(")","").split(",");
        converted_color = "#" + toHex(color[0]) + toHex(color[1]) + toHex(color[2]);
    }
    else if(color.length <=7 && color.indexOf("#") == 0){
        color = color.replace("#","");
        converted_color = "rgb(" + parseInt(color.substring(0,2),16) + "," + parseInt(color.substring(2,4),16) + "," + parseInt(color.substring(4,6),16) + ")";
    }
    else if(color.indexOf("cmyk(" === 0) && color.length <= 21 && color.length >= 13 && color.indexOf(")") == color.length -1){
        color = color.replace("cmyk(","").replace(")","").split(",");
        var c = (color[0]/100);
        var m = (color[1]/100);
        var y = (color[2]/100);
        var k = (color[3]/100);
        converted_color = "rgb(" + Math.round(255 * (1 - c) * (1-k)) + "," + Math.round(255 * (1 - m) * (1-k)) + "," + Math.round(255 * (1 - y) * (1-k)) + ")";
    }

    return converted_color;
};

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
        var template = nexus.get_template(this.id);
        if(template){
          //window.cw = template;
          //console.debug($(template));
          //console.debug($(template).find('tr')[0]);
          var new_row = this.tBodies[0].appendChild(document.createElement("tr"));
          $(new_row).replaceWith(template);

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
  parse_template: function(template,data){
    template = template || '';
    data = data || {};
    /*todod
    var check = mixed_input.split(" ");
    var template = null;
    if(check.length > 1){
      template = mixed_input;
    }
    else{
      template = nexus.find_template(mixed_input) || '';
    }*/
    //
    // var re = /\(#(.*?)#\)/g;
    // var str = 'hello (#world#) (#city#)';
    // var subst = 'test';
    //
    // var result = str.replace(re, subst);

    var re = /\(#(.*?)#\)/g;
    var str = template;

    var m;

    while ((m = re.exec(str)) !== null) {

        if (m.index === re.lastIndex) { re.lastIndex++; }

        var variable_name = m[0].replace("(#","").replace("#)","");
        if(data[variable_name]){
          template = template.replace(m[0],data[variable_name].toString());
        }
    }
    return template;

  },

  get_template: function(id){

    var template = null;

    if(id){
        template = $(id) || $('#'+id) || $('#template_'+id);
    }

    if(template){
      template = $(template).text();
    }

    return template;
  }
};

$(document).ready(nexus.init);

//window.history.pushState([], "Title", "/new-url");
