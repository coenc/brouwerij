<!DOCTYPE html>
<html lang="nl">

	<head>
    	@include('partials._head')
    	
    </head>

    <body>

		<div id='cookie_alert' class="row"></div>

        @include('partials._messages')
        @include('partials._menu')
             
        <div class="content">

		    <div class="page-header">
		        <div class="row">
		            <div class="col-md-8">
		                <h3>@yield('title')</h3>    
		            </div>
		        </div>
		    </div>

	        @yield('content')

        </div><!--div content-->

    <?php
		setlocale(LC_ALL, 'nl');
		// setlocale(LC_TIME, 'nld_nld');
		// setlocale(LC_MONETARY, 'nld_nld');
		// setlocale(LC_NUMERIC, 'nld_nld');
		// App::setLocale('nl');	
		// $locale = App::getLocale();
		// echo $locale;

		$locale_info = localeconv();
		// echo('<pre>');
	    //echo(print_r($locale_info));	
	    // echo('</pre>');
	    // echo 'decimal_point=', $locale_info['decimal_point'];
		
    ?>

    <?php
		if (false !== setlocale(LC_ALL, 'nl_NL.UTF-8@euro')) {
		    $locale_info = localeconv();
		    print_r($locale_info);
		}
	?>

    </body>
    
	@include('partials._scripts')
	
	@yield('scripts')
	
	<script type="text/javascript">
		$(document).ready(function() {
			
            // Cookie melding
            var cookie_message = '<div class="alert alert-warning text-center" role="alert" ><strong>Cookie melding: </strong>Deze webapplicatie maakt GEEN gebruik van tracking cookies.<button class="btn btn-warning btn-xs  but-spacing" id="close_cookie">Akkoord</button></div>';
            
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

</html>
