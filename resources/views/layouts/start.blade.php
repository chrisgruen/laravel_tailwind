<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('PLATFORM_TITLE','StaatsImmobilien')}} - @yield('title')</title>

    @yield('styles')
    <link href="/css/app.css" rel="stylesheet">

    @stack('css')
</head>
	<body>
        @include('layouts.partials.header_start')
        
        <div class="grid lg:container lg:mx-auto lg:grid-cols-4 px-4 gap-3">
            <div class="lg:col-span-1 p-2">@include('layouts.partials.left_menu_start')</div>
            <div class="lg:col-span-3 p-2">@yield('content')</div>
        </div>
        @yield('subsection_2')
        @yield('subsection_3')
        @include('layouts.partials.footer')
    
    	<!-- Scripts -->
    	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    	
    	@stack('scripts')
        <script>
        
        </script>
	</body>
</html>