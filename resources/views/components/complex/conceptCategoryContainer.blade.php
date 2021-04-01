<div id="group_{{$id_cat}}" class="cat-group groups">
    <div id="cat_{{$id_cat}}" class="flex flex-wrap  mb-4 mb-1 cat-item">
        <div class="w-3/4 cat-label">
            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded category-txt font-bold" value="{{$name}}" {{($readonly?"readonly":"")}} >
        </div>
        <div class="w-1/4 cat-val">
            @if($readonly === true)
                <label>{{(isset($value)?$value:"")}} %</label>
            @elseif($readonly=="rate")
            @else
                <div class="relative flex items-stretch w-full">
                    <input type="number" step="1" min="1" max="100" id="catprocent_{{$id_cat}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded font-bold number-input catprocent" placeholder="25" value="{{(isset($value)?$value:"")}}">
                    <div class="input-group-append">
                        <span class="text-xs">%</span>
                        @if(!$readonly)
                            &nbsp;<span class="text-xs delete cCategoryDeleteButton" id="{{$groupID}}"><span class="fa fa-trash" aria-hidden="true"></span></span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="crits mt-0 mb-0" id="crits_{{$groupID}}">
        {{$slot}}
    </div>

    @if($readonly!==true && $readonly!=="rate")
        <div class="flex flex-wrap   mt-1 mb-0">
            <div class="w-3/4 mt-0 mb-2">
                <div class="flex flex-wrap  no-gutters">
                    <div class="w-2/5">
                        @if(!$readonly)
                        <button type="button" id="{{$groupID}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs  cbAddCriteriaButton">@lang('messages.addCriteria')</button>
                        @endif
                    </div>
                    <div class="w-3/5 mt-0 text-right"><label class="perc_text text-xs">@lang('messages.100PercentNeeded')</label></div>
                </div>
            </div>
            <div class="w-1/4 mt-0"><label class="perc_value">33 %</label></div>
        </div>
        <div class="label_text danger">@lang('messages.pleaseFillCriteria')</div>
    @endif
</div>



