@if(!empty($supplier))
    <div class="flex flex-wrap  mb-1 text-small-response">
        <div class="sm:w-1/2 pr-4 pl-4 font-bold">@lang('messages.'.$slot):</div>
        <div class="sm:w-1/2 pr-4 pl-4 text-right">
            @if(empty($supplier))
                @lang('messages.na')
            @else
                {{$supplier->name}}
                <span data-toggle="tooltip" title="" data-original-title="<div><b>{{$supplier->name}}</b><br/>{{$supplier->address}}<br/>{{$supplier->zipcode}} {{$supplier->city}}<br/>{{$supplier->contact}}<br/>{{$supplier->phonenumber}}<br/>{{$supplier->email}}</div>"> <i class="fa fa-info-circle"></i> </span>
            @endif
        </div>
    </div>
@endif