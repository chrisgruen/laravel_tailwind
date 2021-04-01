<div class="mb-4 flex flex-wrap ">
    <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
    <check class="lg:w-3/4 pr-4 pl-4 block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded {{$slot}}" style="background-color: #fff; border: none; height: unset;">
        @if(isset($realArray)&&$realArray===true)
            @foreach($options as $key=>$val)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="{{$slot}}[]" id="{{isset($key_val)?$key:str_replace(' ', '_', $val)}}" autocomplete="off" value="{{isset($key_val)?$key:$val}}" @if(isset($value_array)) @if(in_array(isset($key_val)?$key:$val, $value_array)) checked @endif @endif>
                    <label class="custom-control-label" for="{{isset($key_val)?$key:str_replace(' ', '_', $val)}}">{{$val}}</label>
                </div>
            @endforeach
        @elseif(isset($realArray)&&$realArray=="semi")
            @foreach($options as $key=>$val)
                <div class="custom-control custom-checkbox" >
                    <input type="checkbox" class="custom-control-input" name="{{$slot}}[]" id="{{isset($key_val)?$key:str_replace(' ', '_', $val)}}" value="{{isset($key_val)?$key:$val}}" autocomplete="off" @if(isset($value_array)) @if(in_array(isset($key_val)?$key:$val, $value_array)) checked @endif @endif>
                    <label class="custom-control-label" for="{{isset($key_val)?$key:str_replace(' ', '_', $val)}}">@lang((isset($lang)?$lang:'messages').'.'.$val)</label>
                </div>
            @endforeach
        @else
            @if(isset($options) && count($options) > 1)
                @foreach($options as $key=>$val)
                    <div class="custom-control custom-checkbox" >
                        <input type="checkbox" class="custom-control-input" name="{{$slot}}[]" id="{{$key}}_{{$val}}" value="1" autocomplete="off" @if($value == 1) checked @endif>
                        <label class="custom-control-label" for="{{$key}}_{{$val}}">@lang((isset($lang)?$lang:'messages').'.'.$val)</label>
                    </div>
                @endforeach
            @else
                <div class="custom-control custom-checkbox" >
                    <input type="checkbox" class="custom-control-input" name="{{$option}}" id="{{$option}}" value="1" autocomplete="off" @if($value == 1) checked @endif>
                    <label class="custom-control-label" for="{{$option}}">@lang('messages.'.$option)</label>
                </div>
            @endif
        @endif
    </check>
</div>

