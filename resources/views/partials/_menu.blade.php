<nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">BIS<span class="pull-left hidden-xs showopacity glyphicon glyphicon-glass"></span></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">

			@if(Auth::check())
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Producten<span class="caret"></span><span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-star-empty"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="{{Request::is('producten') ? 'active' : ''}}"><a href="/producten">Producten</a></li>
						<li class="{{Request::is('productcategorieen') ? 'active' : ''}}"><a href="/productcategorieen">Productcategorieën</a></li>
					</ul>
				</li>	

				<li class="{{Request::is('recepten') ? 'active' : ''}}"><a href="/recepten">Recepten<span style="font-size:16px;" class="pull-left hidden-xs showopacity"><i class="icon-copy" style="margin-right:5px"></i></span></a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Grondstoffen<span class="caret"></span><span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-grain"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="{{Request::is('grondstoffen') ? 'active' : ''}}"><a href="/grondstoffen">Grondstoffen</a></li>
						<li class="{{Request::is('grondstofcategorieen') ? 'active' : ''}}"><a href="/grondstofcategorieen">Grondstof categorieën</a></li>
						<li class="divider"></li>
						<li class="{{Request::is('inkoopgrondstoffen') ? 'active' : ''}}"><a href="/inkoopgrondstoffen">Inkoop grondstoffen</a></li>
						<li class="{{Request::is('verbruikgrondstoffen') ? 'active' : ''}}"><a href="/verbruikgrondstoffen">Verbruik grondstoffen</a></li>

					</ul>
				</li>				
				
				<li class="{{Request::is('productie') ? 'active' : ''}}"><a href="/productie">Productie<span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-tint"></span></a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Rapportages<span class="caret"></span><span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-stats"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="{{Request::is('rapportage/productie') ? 'active' : ''}}"><a href="/rapportage/productie">Productie</a></li>
						<li class="{{Request::is('rapportage/accijnsafdracht') ? 'active' : ''}}"><a href="/rapportage/accijnsafdracht">Accijnsafdracht</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">CRM<span class="caret"></span><span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="{{Request::is('klanten') ? 'active' : ''}} disabled"><a href="/klanten">Klanten</a></li>
						<li class="divider"></li>
						<li class="{{Request::is('leveranciers') ? 'active' : ''}}"><a href="/leveranciers">Leveranciers</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Gebruiker<span class="caret"></span><span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-user"></span></a>
						
					<ul class="dropdown-menu forAnimate" role="menu">
						{!!(Auth::check()?'<li><a href="/auth/logout">Logout</a></li>' : '')!!}
						{!!(Auth::check()?'<li ><a href="/mijnprofiel">Mijn profiel</a></li>' : '')!!}
					</ul>
				</li>
			
			@endif
			</ul>

		</div>
	</div>
</nav>