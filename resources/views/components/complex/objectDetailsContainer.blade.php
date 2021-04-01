<div class="flex flex-wrap  groupModifier" id="odc_{{$groupID}}" data-odc="{{$groupID}}" >

    <label class="lg:w-1/4 pr-4 pl-4" for="@lang('messages.'.$groupID)">@lang('messages.'.$groupID) </label>
    <div class="lg:w-3/4 pr-4 pl-4 immo-input">
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="odd_{{$groupID}}_button" data-toggle="modal" data-target="#odd_{{$groupID}}">@lang('messages.'.$groupID) @lang('messages.set')</button>
        <div class="form-input-overview" id="odco_{{$groupID}}"></div>
    </div>
    {{$slot}}
</div>





