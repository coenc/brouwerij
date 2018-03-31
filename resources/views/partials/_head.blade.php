    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/js.cookie.js"></script><!-- https://github.com/js-cookie/js-cookie  -->

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('c628125df01b182b5e93', {
          cluster: 'eu',
          encrypted: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          alert(data.message);
        });
    </script>




    <!--Bootstrap-->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <link href="/css/bootstrap.min.css" rel="stylesheet" />

    <!--  SweetAlert  -->
	<link rel="stylesheet" href="/css/sweetalert2.min.css">
    
    {{-- Bootstrap date-picker: https://vitalets.github.io/bootstrap-datepicker/# --}}
    <link rel="stylesheet" href="/css/datepicker.css">
    
    {{-- DataTables --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css"/>
    
    {{-- Font awesome --}}
    {{-- <link href="/css/font-awesome.css" rel="stylesheet"> --}}
    
    <style>

        #about_button{
            cursor: pointer;
        }
        #group_logo{
            /*centreer image*/
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #logo_row{
           float: none; 
           margin: 0 auto;
        }
        #logo_well{
            box-shadow: 10px 10px 5px #888888 !important;
        }
        .glyphicon {
            margin-right: 5px;
        }
        .but-spacing{
            margin-left:3px !important;
            border-radius: 5px !important;
        }
        .but-spacing > .glyphicon{
            margin-right:4px;
        }
        .but-spacing > .buttontext{
            display: inline !important;
        }
        .tooltip-questionmark{
            opacity: 0.250;
            font-size: 12px;
        }
        #ajaxloader{
            display: none;
            position:relative;
            z-index: 1;
            width:150px;
            height:100px;
            position:absolute;
            left:50%;
            top:50%;
            margin:-50px 0 0 -75px;
        }
        #ajaxloader > #img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .datepicker {
            /* Appended to body, abs-pos off the page */
            position: absolute;
            display: none;
            top: -9999em;
            left: -9999em;
        }
        .page-header {
            margin: 0px 0 20px 20px !important;
        }
        .navbar{
            margin-bottom: 0px !important;
        }
        #beer_image{
            margin-top:40px;
        }
        .alert{
            margin:0;
        }
        .container{
            padding:0;
        }
    </style>
    
	@yield('css')
    
	<title>BIS | @yield('title')</title>

