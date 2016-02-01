var nexus_gplus_init = function(){
  nexus.gplus.init();
};

var nexus = nexus || {};

nexus.gplus = {
  init: function(){
    gapi.load('auth2', function() {
      gapi.client.load('plus','v1').then(function() {
        gapi.signin2.render('signin-button', {
            scope: 'https://www.googleapis.com/auth/plus.login',
            fetch_basic_profile: false }
        );
        gapi.auth2.init({
          fetch_basic_profile: false,
          scope:'https://www.googleapis.com/auth/plus.login'}).then(
              function (){
                auth2 = gapi.auth2.getAuthInstance();
                auth2.isSignedIn.listen(nexus.gplus.status);
                auth2.then(nexus.gplus.status);
              });
        });
    });
    $(".gplus.sign_in").click(function(){
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signIn();
    });
    $(".gplus.sign_out").click(function(){
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut();
    });
    $(".gplus.disconnect").click(nexus.gplus.disconnect);
  },
  status: function(){

    if (auth2.isSignedIn.get()) {
      $(".gplus.logged_in_only").show();
      $(".gplus.logged_out_only").hide();
      nexus.gplus.status_changed(gapi.auth2.getAuthInstance());
    }else{
      $(".gplus.logged_in_only").hide();
      $(".gplus.logged_out_only").show();
      nexus.gplus.status_changed(gapi.auth2.getAuthInstance());
    }
  },
  status_changed: function(authResult){
    if (authResult.isSignedIn.get()) {
      nexus.gplus.profile();
    } else {
      if (authResult['error'] || authResult.currentUser.get().getAuthResponse() == null) {
        console.debug('There was an error: ' + authResult['error']);
      }
      else{
        console.debug("some other error ocurred");
      }
    }
  },
  disconnect: function() {
    auth2.disconnect();
  },
  profile: function(){
    gapi.client.plus.people.get({
      'userId': 'me'
    }).then(function(res) {
      var profile = res.result;
      $(".gplus.user.name").html(profile.displayName);
      $("img.gplus.user.image").attr("src",profile.image.url);
    }, function(err) {
      console.debug(err.result);
    });
  }
};
