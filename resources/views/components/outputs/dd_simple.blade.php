@if(!empty($value))
    @lang('messages.'.$slot):
    {{(isset($addonText)&& $addonText=="m²"?trans("messages.approx")." ":"")}} {{$value}} {{(isset($addonText)?$addonText:"")}}<br/>
@endif