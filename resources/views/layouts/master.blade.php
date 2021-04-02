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
	<body class="bg-gray-100 tracking-wider tracking-normal pt-0">        
        <div class="container w-full flex flex-wrap mx-auto px-2 pt-0">
            <div class="w-full lg:w-1/5 lg:px-6 text-xl pt-5 text-gray-800 leading-normal">
            	<div class="mb-5">
            		<a class="inline-block pl-3" href="{{ url('/')}}"><img alt="Brand" src="/img/logos/logo_staatsimmobilien.svg"></a>
        		</div>
            	@include('layouts.partials.left_menu')
        	</div>
            <div class="w-full lg:w-4/5 p-9 mt-6 lg:mt-0 h-screen text-gray-900 leading-normal bg-white">
            	@include('layouts.partials.content_header')
            	@yield('content')
        	</div>
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