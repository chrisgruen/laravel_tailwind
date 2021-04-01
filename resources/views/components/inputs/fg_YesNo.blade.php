@if(isset($form_group_row))
    <div id="{{$slot}}" class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">@lang('messages.'.$slot)</label>
        <div class="lg:w-1/3 pr-4 pl-4 relative inline-flex align-middle btn-group-toggle" data-toggle="buttons">
            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 radio-button-space @if(isset($value) && $value==1) active @endif>">
                <input type="radio" name="{{$slot}}" id="option_yes" value="1" autocomplete="off" @if(isset($value) && $value==1) checked @endif>@lang('messages.yes')
            </label>
            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 radio-button-space @if(!isset($value) || $value!=1) active @endif">
                <input type="radio" name="{{$slot}}" id="option_no" value="0" autocomplete="off" @if(!isset($value) || $value!=1) checked @endif>@lang('messages.no')
            </label>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">@lang('messages.'.$slot)</label><br />
        <div class="relative inline-flex align-middle btn-group-toggle" data-toggle="buttons">
            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 radio-button-space @if(isset($value) && $value==1) active @endif>">
                <input type="radio" name="{{$slot}}" id="option_yes" value="1" autocomplete="off" @if(isset($value) && $value==1) checked @endif>@lang('messages.yes')
            </label>
            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 radio-button-space @if(!isset($value) || $value!=1) active @endif">
                <input type="radio" name="{{$slot}}" id="option_no" value="0" autocomplete="off" @if(!isset($value) || $value!=1) checked @endif>@lang('messages.no')
            </label>
        </div>
    </div>
@endif
