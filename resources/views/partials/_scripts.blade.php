
{{-- <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
{{-- <script async src="/js/bootstrap.min.js"></script> --}}
{{-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> --}}
<script src="/js/datatables.min.js"></script>
<script src="/js/sweetalert2.min.js"></script>
<script src="/js/parsley.min.js"></script>
{{-- <script async src="/js/js.cookie.js"></script>https://github.com/js-cookie/js-cookie  --}}
<script type="text/javascript" src="/js/jquery.fancybox.js"></script>
<!--
<link rel="stylesheet" href="/css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script async type="text/javascript" src="/js/jquery.fancybox-buttons.js"></script>
<script async type="text/javascript" src="/js/jquery.fancybox-media.js"></script>
-->

<script type="text/javascript">

    // $(function () {
    //   $('[data-toggle="tooltip"]').tooltip()
    // })

	$(document).ready(function() {
		
        $().tooltip({'placement': 'right', 'z-index': '3000'});

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
