
<div class="row col-md-12">
    <p>BIS is a web application for beer brewery administrations. This application has been developed using the <a target="_blank" href="http://www.laravel.com">Laravel MVC PHP framework</a> and various Javascript plugin libraries. It is a project that developed in a process of learning Laravel and shows off my newly acquired programming skills. As this is a showcase application, the source code can be found on <a target="_blank" href="https://www.github.com/coenc/brouwerij">GitHUB</a></p>

    <p><b>FUNCTIONALITY</b></p>
    <li>Product management</li>
    <li>Recipe management</li>
    <li>Materials/stock management, based on production and purchases.</li>
    <li>Brew planning, considering available materials</li>
    <br>

    <p><strong>SECURITY</strong></p>
    <p>All data is securely behind a safe login system. The application has been secured against XSS Cross Site Scripting and code injection. Passwords are stored in encrypted format. The application is hosted on Amazon with SSL encrypted communications.</p>

    <p><strong>JAVASCRIPT LIBRARIES</strong></p>
    <p>Besides the Laravel framework, the following Javascript libraries have been used:
    	<li>Twitter Bootstrap for a responsive, mobile friendly user-interface</li>
    	<li>jQuery for a interactive user-interface</li>
    	<li>AJAX for updating pages without refreshing the page</li>
    	<li>SweetAlert for displaying messages and confirmations</li>
    	<li>FancyBox to display clickable images </li>
    	<li>ParsleyJS for form data validation</li>
    	<li>htmlPurifier for protection against cross site scripting (XSS)</li>
    	<li>jsDataTables for sorting, paginating and ordering of html tables</li>
    	<li>Select2 for a searchable listboxes</li>
    	<li>Bootstrap DatePicker for input fields with calendar</li>
    	<li>HighCharts for charts</li>
    	<li>ImageIntervention for image manipulation/watermarks</li>
    </p>

    <p><strong>SOFTWARE VERSIONS</strong></p>
    <p>
        <div>Laravel v.{!! App::Version()!!}</div>
        <div>PHP v.{{ $phpversion }}</div>
        <div id="jquery_version">jQuery v.</div>
        <div id="apacheversion">Apache {{ $apacheversion }}</div>
        <div id="screen">Screen </div>
    </p>

</div>