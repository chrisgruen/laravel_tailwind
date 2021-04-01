@if(isset($form_group_row))
<div class="mb-4 flex flex-wrap ">
    <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">
        {{(isset($label)?$label:trans('messages.'.$slot))}}
    </label>
    <div class="lg:w-3/4 pr-4 pl-4">
        <div class="relative flex items-stretch w-full">
            @if(isset($addon1))
                <div class="input-group-prepend"><span class="input-group-text">{{$addon1}}</span></div>
            @endif
            <input type="{{(isset($type)?$type:"text")}}" {!! (isset($type)&&$type=="number"?"step='1' min='1' ":"")!!}
                   class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded number-input" id="{{$slot}}" name="{{$slot}}" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" value="{{(isset($value)?$value:"")}}" data-addon="{{$addon2}}"
                   @if(isset($disabled)) disabled @endif
            >
            @if(isset($addon2))
                <div class="input-group-append"><span class="input-group-text" id="basic-addon2" data-addon="Test">{{$addon2}}</span></div>
            @endif
        </div>
    </div>
</div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">
            {{(isset($label)?$label:trans('messages.'.$slot))}}
        </label>
        <div class="relative flex items-stretch w-full">
            @if(isset($addon1))
                <div class="input-group-prepend"><span class="input-group-text">{{$addon1}}</span></div>
            @endif
            <input type="{{(isset($type)?$type:"text")}}" {!! (isset($type)&&$type=="number"?"step='1' min='1' data-fv-integer-message='".trans('messages.integerOnly')."'":"")!!}
                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded number-input" id="{{$slot}}" name="{{$slot}}" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" value="{{(isset($value)?$value:"")}}" data-addon="?"
            >
            @if(isset($addon2))
                <div class="input-group-append"><span class="input-group-text" id="basic-addon2">{{$addon2}}</span></div>
            @endif
        </div>
    </div>
@endif
