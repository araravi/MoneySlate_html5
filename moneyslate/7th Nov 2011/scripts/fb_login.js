window.fbAsyncInit = function () {
FB.init({ appId: '190942770985124', status: true, cookie: true, xfbml: true });
	 FB.Event.subscribe('auth.login', function (response) {
       window.location="http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/home.php";
	
		});	
		  FB.getLoginStatus(function (response) {
if (response.session) {	
	window.location="http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/home.php";
  }
	  else
	  {
		
	  }
});
};
(function () {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol +
    '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
} ());