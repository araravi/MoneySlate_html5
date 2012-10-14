<script>
  window.fbAsyncInit = function() {
    FB.init({ appId: '190942770985124', 
      status: true, 
      cookie: true,
      xfbml: true,
      oauth: true});

      FB.Event.subscribe('auth.statusChange', handleStatusChange);  
    };
</script>