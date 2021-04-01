<footer class="w-full z-10 bottom-0 bg-gray-600 py-2">
	<nav class="lg:container lg:mx-auto mt-0 ">
        <ul class="list-none flex justify-around text-white justify-evenly">
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"faq"]) }}" class="no-underline hover:underline">@lang('messages.faq')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"glossary"]) }}" class="no-underline hover:underline">@lang('messages.glossar')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"contact"]) }}"class="no-underline hover:underline">@lang('messages.contact')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"prices"]) }}"class="no-underline hover:underline">@lang('messages.prices')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"agb"]) }}"class="no-underline hover:underline">@lang('messages.agb')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"privacy"]) }}" class="no-underline hover:underline">@lang('messages.privacy')</a></li>
            <li class="inline-block"><a href="{{ route('content',["pageContent"=>"imprint"]) }}" class="no-underline hover:underline">@lang('messages.imprint')</a></li>
        </ul>
    </nav>
    <div id="modal-ajax-loader"></div>
</footer>