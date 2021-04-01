@if(isset($form_group_row))
    <div class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="lg:w-3/4 pr-4 pl-4">
            <div class="relative flex items-stretch w-full">
                <input id="{{$slot}}" name="{{$slot}}" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">
                <span class="input-group-text"><i class="fa fa-edit" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="relative flex items-stretch w-full">
            <input id="{{$slot}}" name="{{$slot}}" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">
            <span class="input-group-text"><i class="fa fa-edit" aria-hidden="true"></i></span>
        </div>
    </div>
@endif