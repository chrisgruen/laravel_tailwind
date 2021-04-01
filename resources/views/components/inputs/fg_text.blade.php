@if(isset($form_group_row))
    <div data-belong="{{$slot}}" class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="lg:w-3/4 pr-4 pl-4">
            <div class="relative flex items-stretch w-full {{(isset($clear_field)?"has-clear":"")}}">
                <input id="{{$slot}}" name="{{$slot}}" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" value="{{(isset($value)?$value:"")}}"
                    {!! (isset($notemptyMessage)?"data-fv-not-empty___message=\"".$notemptyMessage."\"":"") !!} {{(isset($special)?$special:"")}}
                    @if(isset($placeholder)) placeholder="{{$placeholder}}" @endif
                >
                @if(isset($clear_field))
                    <span class="form-clear hidden"><i class="fas fa-times" aria-hidden="true"></i></span>
                @endif
                <span class="input-group-text"><i class="fas fa-edit" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
@else
    <div data-belong="{{$slot}}"  class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="relative flex items-stretch w-full {{(isset($clear_field)?"has-clear":"")}}">
            <input id="{{$slot}}" name="{{$slot}}" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}" value="{{(isset($value)?$value:"")}}"
                {!! (isset($notemptyMessage)?"data-fv-not-empty___message=\"".$notemptyMessage."\"":"") !!} {{(isset($special)?$special:"")}}
            >
            @if(isset($clear_field))
                <span class="form-clear hidden"><i class="fas fa-times" aria-hidden="true"></i></span>
            @endif
            <span class="input-group-text"><i class="fas fa-edit" aria-hidden="true"></i></span>
        </div>
    </div>
@endif