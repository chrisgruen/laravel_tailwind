@if(isset($form_group_row))
    <div class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="lg:w-3/4 pr-4 pl-4">
            <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="{{$slot}}"  name="{{$slot}}" rows="3" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">{{(isset($value)?$value:"")}}</textarea>
        </div>
    </div>
@else
    <div class="mb-4">
        <label class="font-bold" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="{{$slot}}"  name="{{$slot}}" rows="3" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">{{(isset($value)?$value:"")}}</textarea>
    </div>
@endif