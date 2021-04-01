@if(isset($form_group_row))
    <div id="{{$slot}}" class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="lg:w-1/3 pr-4 pl-4">
            <div class="mb-4 toggle-check-button">
                <input  type="checkbox" id="{{$slot}}" name="{{$slot}}" data-toggle="toggle" data-size="sm" @if(isset($value) && $value==1) checked @endif data-width="75" data-on="{{isset($txt_on)?$txt_on:trans('messages.yes')}}" data-off="{{isset($txt_on)?$txt_on:trans('messages.no')}}">
            </div>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label><br />
        <div class="relative inline-flex align-middle btn-group-toggle">
            <div class="mb-4 toggle-check-button">
                <input  type="checkbox" id="{{$slot}}" name="{{$slot}}" data-toggle="toggle" data-size="sm" @if(isset($value) && $value==1) checked @endif data-width="75" data-on="{{isset($txt_on)?$txt_on:trans('messages.yes')}}" data-off="{{isset($txt_on)?$txt_on:trans('messages.no')}}">
            </div>
        </div>
    </div>
@endif