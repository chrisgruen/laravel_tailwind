<nav id="header" class="w-full z-10 mt-0 bg-white border-b border-gray-400">
    <div class="grid lg:container lg:mx-auto lg:grid-cols-4 px-4 mb-2 mt-0 gap-3">
        <div class="lg:col-span-1 p-2">
            <a class="inline-block pl-5 pt-1 pb-1" href="{{ url('/')}}">
            	<img alt="Brand" src="/img/logos/logo_staatsimmobilien.svg">
            </a>
        </div>
        <div class="lg:col-span-3 p-2 my-auto">
        	<h1 class="text-3xl text-gray-900 tracking-tight text-right border-bottom">@yield('header_pagetitle')</h1>
        </div>
    </div>
</nav>