<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">@lang('messages.showAll')</div>
    <div class="flex-auto p-6 no-border-top">
        <form action="" id="searchForm" method="post" onsubmit="return false;">
            <input id="marketType" name="marketType" type="hidden" value="">
            <input id="app_url" name="app_url" type="hidden" value="{{env('APP_URL')}}">
            <input type="hidden" name="sub" value="{{Helper::getSub()}}">
            <div class="mb-4 flex flex-wrap ">
                <label class="lg:w-1/4 pr-4 pl-4" for="objectID">@lang('messages.where')</label>
                <div class="lg:w-3/4 pr-4 pl-4">
                    <div class="relative flex items-stretch w-full input-group-response has-clear">
                        <input id="immoLocation" name="immoLocation" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded basicAutoComplete" placeholder="@lang('messages.searchGeo')" value="{{$immoLocation}}">
                        <span class="form-clear clear-immo hidden"><i class="fas fa-times" aria-hidden="true"></i></span>
                        <div class="input-group-append" id="div-distance">
                            <span class="input-group-text">@lang('messages.radius'):</span>
                            <select id="radius" name="radius" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded">
                                @foreach(Helper::opt_radius() as $key => $dist)
                                    <option value="{{$key}}" @if($key == $radius) selected="selected" @endif>{{$dist}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 flex flex-wrap ">
                <label class="lg:w-1/4 pr-4 pl-4" for="type">@lang('messages.what')</label>
                <div class="lg:w-3/4 pr-4 pl-4">
                    <select id="type" name="type" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                        <option value="">@lang('messages.allType')</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 flex flex-wrap ">
                <label class="lg:w-1/4 pr-4 pl-4" for="subType"></label>
                <div class="lg:w-3/4 pr-4 pl-4">
                    <select id="subType" name="subType" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                        <option value="">@lang('messages.allSubtypes')</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="flex flex-wrap  flex-col-reverse lg:flex-row">
            <div class="lg:w-1/2 pr-4 pl-4 text-right lg:text-left mt-2 md:mt-4 mobil-button">
                {{-- <a href="{{route('search.clearForm')}}" id="clear-form" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default">@lang('messages.clearForm')</a> --}}
            </div>
            <div class="relative flex-grow max-w-full flex-1 px-4 lg:w-1/2 pr-4 pl-4 text-right mobil-button">
                <div id="immolocation_count"></div>
                @if(Auth::guard()->check())
                    <button type="button" id="saveSearchButton" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" disabled>@lang('messages.saveSearch')</button>
                @endif
                <button type="button" id="searchButton" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default">@lang('messages.showAll')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

</script>
@endpush
