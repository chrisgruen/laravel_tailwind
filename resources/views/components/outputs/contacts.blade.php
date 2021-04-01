@if($contacts->isEmpty())
    <div>@lang('messages.na')</div>
@else
    <div class="accordion-started" id="a1-{{$slot}}" role="tablist" aria-multiselectable="false">
        @foreach($contacts as $contact)
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900" role="tab" id="heading-{{$slot}}">
                    <a class="collapsed" data-toggle="collapse" href="#ac1-{{$slot}}-{{$contact->id}}"  aria-expanded="true" aria-controls="ac1-{{$slot}}-{{$contact->id}}">
                        <h5 class="mb-0 font-bold"><i class="fas fa-angle-down rotate-icon"></i> &nbsp;&nbsp;
                            @lang('messages.title_'.$contact->title) {{$contact->firstname}} {{$contact->lastname}}
                        </h5>
                    </a>
                </div>
                <div id="ac1-{{$slot}}-{{$contact->id}}" class="hidden" role="tabpanel" aria-labelledby="heading-{{$slot}}-{{$contact->id}}">
                    <div class="flex-auto p-6 no-border-all">
                        @if(!empty($contact->phonenumber))
                            <div class="flex flex-wrap  mb-0">
                                <label class="md:w-1/4 pr-4 pl-4">@lang('messages.phonenumber')</label>
                                <div class="md:w-2/3 pr-4 pl-4"><a href="tel:{{$contact->phonenumber}}">{{$contact->phonenumber}}</a></div>
                            </div>
                        @endif
                        @if(!empty($contact->mobilenumber))
                            <div class="flex flex-wrap  mb-0">
                                <label class="md:w-1/4 pr-4 pl-4">@lang('messages.mobilenumber')</label>
                                <div class="md:w-2/3 pr-4 pl-4"><a href="tel:{{$contact->mobilenumber}}">{{$contact->mobilenumber}}</a></div>
                            </div>
                        @endif
                        @if(!empty($contact->email))
                            <div class="flex flex-wrap  mb-0">
                                <label class="md:w-1/4 pr-4 pl-4">@lang('messages.email')</label>
                                <div class="md:w-2/3 pr-4 pl-4"><a href="mailto:{{$contact->email}}?subject=@lang('messages.objectID'){{(": ".$auction->name)}}" >{{$contact->email}}</a></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif