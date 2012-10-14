var userID;
var friends;

FB.init({appId: '190942770985124', status: true, cookie: true, xfbml: true});

FB.getLoginStatus(function(response) {
	if (response.session) {
	   
	} else {
	// no user session available, someone you dont know
		window.location = "http://mymoneyslate.com/index.php";
	}
});

function fb_logout() {
	//alert("works");
	FB.logout(function(response) {
		window.location = "http://mymoneyslate.com/index.php";
	});
}

$('#logout').live('click',function(){
fb_logout();
});