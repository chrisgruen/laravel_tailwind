<div class="w-full sticky inset-0 hidden h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:5em;" id="menu-content">
    <ul class="list-inside ml-3">
        <li class="py-2 md:my-0 hover:bg-red-100 lg:hover:bg-transparent">
            <a href="{{ route('auction.search')}}" class="block pl-4 align-middle text-gray-700 no-underline hover:text-red-600 border-l-4 border-transparent lg:border-red-600 lg:hover:border-red-600">
            	<span class="pb-1 md:pb-0 text-sm text-gray-900 font-bold">@lang('messages.find')</span>
        	</a> 
        </li>
        <li class="py-2 md:my-0 hover:bg-red-100 lg:hover:bg-transparent">
            <a href="{{ route('register') }}" class="block pl-4 align-middle text-gray-700 no-underline hover:text-red-600 border-l-4 border-transparent lg:border-red-600 lg:hover:border-red-600">
            	<span class="pb-1 md:pb-0 text-sm text-gray-900 font-bold">@lang('messages.register')</span>
        	</a> 
        </li>
        <li class="py-2 md:my-0 hover:bg-red-100 lg:hover:bg-transparent">
            <a href="{{ route('login') }}" class="block pl-4 align-middle text-gray-700 no-underline hover:text-red-600 border-l-4 border-transparent lg:border-red-600 lg:hover:border-red-600">
            	<span class="pb-1 md:pb-0 text-sm text-gray-900 font-bold">@lang('messages.login')</span>
        	</a> 
        </li>
    </ul>
</div>