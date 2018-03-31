<!DOCTYPE html>
<html lang={{ config('app.locale') }}>

	<head>
    	@include('partials._head')
    </head>

    <body>

		<div id='cookie_alert' class="row"></div>
        
        @include('partials._menu')
        @include('partials._messages')

        <div class="content">
			<div class="container">

			    <div class="page-header">
			        <div class="row">
			            <div class="col-md-8">
			                <h3>@yield('title')</h3>    
			            </div>
			        </div>
			    </div>

		        @yield('content')
	        
	        </div><!--div content-->

        </div><!--div container-->

    </body>
    
	@include('partials._scripts')
	
	@yield('scripts')
	
</html>
