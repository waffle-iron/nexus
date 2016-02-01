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
