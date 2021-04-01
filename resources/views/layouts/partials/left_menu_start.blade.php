<div id="sidebar-container">
    <ul class="list-none">
		<li class="{{ ( Route::currentRouteName()=='auction.search' ? 'active':'') }}">
			<a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 {{ ( Route::currentRouteName()=='auction.search' ? 'active':'') }}" href="{{ route('auction.search')}}">@lang('messages.find')</a>
		</li>
		<li>
            <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 {{ ( Route::currentRouteName()=='register' ? 'active':'') }}" href="{{ route('register') }}">@lang('messages.register')</a>
        </li>
        <li>
            <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{ route('login') }}">@lang('messages.login')</a>
        </li>
    </ul>
</div>