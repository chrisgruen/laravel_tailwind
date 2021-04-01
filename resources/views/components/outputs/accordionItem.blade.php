@if(!empty($value))
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
        <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900" role="tab" id="heading-{{$slot}}">
            <a class="collapsed" data-toggle="collapse" href="#ac1-{{$slot}}"  aria-expanded="true" aria-controls="collapse-{{$slot}}">
                <h5 class="mb-0 font-bold"><i class="fas fa-angle-down rotate-icon"></i> &nbsp;&nbsp;@lang('messages.'.$slot)</h5>
            </a>
        </div>
        <div id="ac1-{{$slot}}" class="hidden" role="tabpanel" aria-labelledby="heading-{{$slot}}">
            <div class="flex-auto p-6 no-border-all">
                @if(empty($value))
                    @lang('messages.na')
                @else
                    @if(Helper::isJSON($value))
                        @php $value_array = json_decode($value) @endphp
                        @foreach($value_array as $val)
                            @lang('messages.'.$val) <i class="fa fa-check-square"></i><br />
                        @endforeach
                    @else
                        {!! str_replace(array("\r"),"<br/>",$value) !!}
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{--
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
                   @if(Helper::isJSON($value))
                        @php $value_array = json_decode($value) @endphp
                        @foreach($value_array as $val)
                            @lang('messages.'.$val) <i class="fa fa-check-square"></i><br />
                        @endforeach
                   @else
                        {!! str_replace(array("\r"),"<br/>",$value) !!}
                   @endif
                @endif
            </p>
        </div>
    </li>
    --}}
@endif