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

//window.history.pushState([], "Title", "/new-url");