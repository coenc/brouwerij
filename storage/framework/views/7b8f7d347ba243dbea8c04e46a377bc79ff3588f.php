
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script src="/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/js/datatables.min.js"></script>
<script src="/js/sweetalert2.min.js"></script>
<script src="/js/parsley.min.js"></script>

<!--
<link rel="stylesheet" href="/css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="/js/jquery.fancybox-media.js"></script>
-->
<script src="/js/js.cookie.js"></script><!-- https://github.com/js-cookie/js-cookie  -->

<script type="text/javascript">

	$(document).ready(function() {
		
        // Cookie melding
        var cookie_message = '<div class="alert alert-warning text-center" role="alert" ><strong>Cookie melding</strong><br/>Deze webapplicatie maakt GEEN gebruik van tracking cookies.<div><button class="btn btn-warning btn-xs but-spacing" id="close_cookie">OK, Ik snap het</button></div></div>';
        
        if (Cookies.get('bis') != 'cookieaccept'){
        	//cookie is NOT set
            $('#cookie_alert').append(cookie_message);
        }
        
        $(document).on('click', '#close_cookie', function() {
            Cookies.set('bis', 'cookieaccept', {expires: 365});
            $('#cookie_alert').hide('slow');
        });

	});
    
</script>