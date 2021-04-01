<li>
    <h6 role="tab" id="ah1-{{$groupID}}">
        <a role="button" data-toggle="collapse" data-parent="#a1-{{$groupID}}" href="#ac1-{{$slot}}" aria-expanded="false" aria-controls="ac1-landRegister1" class="collapsed">
            <b>@lang('messages.'.$slot)</b>
            @if(empty($value))
                <div class="pull-right"><b>@lang('messages.na')</b></div>
            @endif
        </a>
    </h6>
    <div id="ac1-{{$slot}}" class="hidden" role="tabpanel" aria-labelledby="ah1" aria-expanded="false" style="height: 0px;">
        <p>@if(empty($value))
                @lang('messages.na')
            @else
                @lang('messages.title_'.$contact->title) {{$con->firstname}} {{$value->lastname}}
            @endif
        </p>
    </div>
</li>
