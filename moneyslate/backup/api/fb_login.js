window.fbAsyncInit = function () {
FB.init({ appId: '137734082990634', status: true, cookie: true, xfbml: true });
	 FB.Event.subscribe('auth.login', function (response) {
	 alert("yes");
     //  window.location="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php";
	
		});	
		  FB.getLoginStatus(function (response) {
if (response.session) {	
	//window.location="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php";
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