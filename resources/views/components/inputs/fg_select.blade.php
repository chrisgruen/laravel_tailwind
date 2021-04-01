@if(isset($form_group_row))
    <div class="mb-4 flex flex-wrap  selectContainer">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">
            {{(isset($label)?$label:trans('messages.'.$slot))}}
        </label>
        <div class="lg:w-3/4 pr-4 pl-4">
            <select id="{{$slot}}" name="{{$slot}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded {{$slot}}" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" data-fv-not-empty___messag="@lang('messages.'.$slot)">
                @if(!isset($noSelectOpt))
                    <option value="">@lang('messages.pleaseChoose')</option>
                @endif
                @if(isset($realArray)&&$realArray===true)
                    @foreach($options as $key=>$val)
                        <option value="{{$key}}" {{(isset($value) && $value==$key?'selected="selected"':"")}}>{{$val}}</option>
                    @endforeach
                @elseif(isset($realArray)&&$realArray=="semi")
                    @foreach($options as $val)
                        <option value="{{$val}}" {{(isset($value) && $value==$val?'selected="selected"':"")}}>@lang('messages.'.$val)</option>
                    @endforeach
                @else
                    @foreach($options as $option)
                        <option value="{{$option}}" {{(isset($value) && $value==$option?'selected="selected"':"")}}>@lang('messages.'.$slot.'_'.$option)</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label>
        <select id="{{$slot}}" name="{{$slot}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" data-fv-not-empty___messag="@lang('messages.'.$slot)">
            <option value="">@lang('messages.pleaseChoose')</option>
            @if(isset($realArray)&&$realArray===true)
                @foreach($options as $key=>$val)
                    <option value="{{$key}}" {{(isset($value) && $value==$key?'selected="selected"':"")}}>{{$val}}</option>
                @endforeach
            @elseif(isset($realArray)&&$realArray=="semi")
                @foreach($options as $val)
                    <option value="{{$val}}" {{(isset($value) && $value==$val?'selected="selected"':"")}}>@lang('messages.'.$val)</option>
                @endforeach
            @else
                @foreach($options as $option)
                    <option value="{{$option}}" {{(isset($value) && $value==$option?'selected="selected"':"")}}>@lang('messages.'.$slot.'_'.$option)</option>
                @endforeach
            @endif
        </select>
    </div>
@endif