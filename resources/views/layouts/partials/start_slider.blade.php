
    <div id="multi_immo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner flex flex-wrap  w-full mx-auto" role="listbox">
            @php $isFirst = true; @endphp
            @foreach($auctions_random as $auction)
                <div class="carousel-item w-full sm:w-1/2 pr-4 pl-4 md:w-1/3 pr-4 pl-4 lg:w-1/4 pr-4 pl-4 {{{ $isFirst ? ' active' : '' }}}">
                {{-- --}}
                <div class="photo">
                    @if(\App\Models\ObjectImage::getTitlePicture($auction->titlePictureID) != 'missingPicture' )
                        <figure class="inline-block mb-4" style="height: auto">
                            <img class="max-w-full h-auto" src= "{{asset('storage/images/'.\App\Models\ObjectImage::getTitlePicture($auction->titlePictureID)."-h200.jpg")}}" width="100%">
                            <div class="text-gray- text-right category">
                                @lang('messages.'.$auction->marketType)
                            </div>
                        </figure>
                    @else
                        <figure class="inline-block mb-4">
                            <img class="max-w-full h-auto" src= "http://placehold.jp/eeeeee/777777/270x200.png?text=kein Foto" width="100%">
                            <div class="text-gray- text-right category">@lang('messages.'.$auction->marketType)</div>
                        </figure>
                    @endif
                </div>
                <div class="item-inner">
                    <h2 class="title"><small class="font-bold">{{$auction->title}}</small></h2>
                    <p class="desc mb-1">{{$auction->street}} {{$auction->street_number}}<br/>{{$auction->zipcode}} {{$auction->city}}<br/>
                        @if($auction['marketType'] == 'build_lease')
                            <span class="font-bold">@lang('messages.'.$auction->marketForm)</span>
                        @else
                            <span class="font-bold">@lang('messages.'.$auction->subType)</span>
                        @endif
                    </p>
                    <p class="text-xs">
                        @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->estateSize])estateSize @endcomponent
                        @if(in_array($auction->type,['','flat']))
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingAreaSize])livingAreaSize @endcomponent
                        @endif
                        @if(in_array($auction->type,['house']))
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>($auction->livingConstructionSize+$auction->livingAreaNetSize)])
                                livingTotalSize @endcomponent
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingAreaNetSize])livingAreaNetSize @endcomponent
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingConstructionSize])livingConstructionSize @endcomponent
                        @endif
                        @if(in_array($auction->type,['house','commercial','parking']))
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>($auction->workConstructionSize+$auction->workAreaNetSize)])workTotalSize @endcomponent
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->workAreaNetSize])workAreaNetSize @endcomponent
                            @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->workConstructionSize])workConstructionSize @endcomponent
                        @endif
                        @if(in_array($auction->type,['house','flat']))
                            @component('components.outputs.dd_simple',["value"=>$auction->rooms])rooms @endcomponent
                        @endif
                        <div class="footer">
                            <a class="link" href="{{route('auction.detail',['auctionName'=>$auction->name])}}" target="_top">@lang('messages.objectView')
                                @if($auction->marketType == 'sale' || ($auction->marketType == 'build_lease' && $auction->marketForm == "best_price"))
                                    <span class="fa fa-gavel" data-toggle="tooltip" title="@lang('messages.auctionEnd') {{date('d.m.Y H:i',strtotime($auction->biddingEnd))}} @lang('messages.oclock')"></span>
                                @endif
                            </a>
                        </div>
                    </p>
                </div>
            </div>
            @php $isFirst = false; @endphp
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#multi_immo" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#multi_immo" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
</div>