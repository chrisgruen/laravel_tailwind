@if(isset($form_group_row))
    <div class="mb-4 flex flex-wrap ">
        <label class="@isset($form_layout_center) md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right @else lg:w-1/4 pr-4 pl-4 @endif"  for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="@isset($form_layout_center) md:w-1/2 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right @else lg:w-3/4 pr-4 pl-4 @endif">
            <div class="relative flex items-stretch w-full">
                <input id="{{$slot}}" name="{{$slot}}" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" data-fv-email-address="true"
                       data-fv-email-address___message="@lang('messages.notAValidEmail')" value="{{(isset($value)?$value:"")}}"
                        {!! (isset($notemptyMessage)?"data-fv-not-empty___message=\"".$notemptyMessage."\"":"") !!} {{isset($readonly)?"readonly":""}}
                >
                <span class="input-group-text"><i class="fa fa-edit" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="relative flex items-stretch w-full">
            <input id="{{$slot}}" name="{{$slot}}" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-notempty="{{(isset($notempty)?$notempty:"false")}}" data-fv-email-address="true"
                   data-fv-email-address___message="@lang('messages.notAValidEmail')" value="{{(isset($value)?$value:"")}}"
                    {!! (isset($notemptyMessage)?"data-fv-not-empty___message=\"".$notemptyMessage."\"":"") !!} {{isset($readonly)?"readonly":""}} >
            >
            <span class="input-group-text"><i class="fa fa-edit" aria-hidden="true"></i></span>
        </div>
    </div>
@endif
