@if(!empty($value))
    <div class="flex flex-wrap  mb-1">
        <div class="md:w-1/2 pr-4 pl-4">
            {{(isset($label)?$label:trans('messages.'.$slot))}}:
        </div>
        <div class="md:w-1/2 pr-4 pl-4">@if(empty($value))
                @lang('messages.na')
            @else
                {{(isset($addonText)&& $addonText=="m²"?trans("messages.approx")." ":"")}} {{(isset($lang_val)?trans("messages.$value"):$value)}} {{(isset($addonText)?$addonText:"")}}
            @endif
        </div>
    </div>
@endif