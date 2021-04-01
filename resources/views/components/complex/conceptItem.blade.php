<div id="crit_{{$id_cat}}_{{$id_crit}}" class="flex flex-wrap  mb-4 crit-item">
    <div class="w-3/4 item-label">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded pl-4 procent-label" placeholder="{{$name}}" value="{{$name}}" data-fv-not-empty="true" {{($readonly?"readonly":"")}}>
    </div>
    <div class="w-1/4 item-val">
        @if($readonly===true)
            <label>{{(isset($value)?$value:"")}} % <span class="show-rating">{{App\Models\Concept::getConceptRating(isset($conceptId) ? $conceptId : 0, $name)}}</span></label>
        @elseif($readonly=="rate")
            <div class="relative flex items-stretch w-full">
                <select name="{{str_random(10)}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-fv-not-empty="true">
                    <option value="">@lang('messages.pleaseChoose')</option>
                    @foreach([1,2,3,4,5,6] as $rateKey)
                        <option value="{{$rateKey}}">@lang('messages.rating_'.$rateKey)</option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="relative flex items-stretch w-full">
                <input type="number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded text-xs procent_val" id="procent_{{$id_cat}}_{{$id_crit}}" data-fv-not-empty="true" step="1" min="1" max="100"
                       data-fv-integer-message="@lang('messages.integerOnly')" placeholder="20" value="{{(isset($value)?$value:"")}}">
                <div class="input-group-append">
                    <span class="text-xs">%</span>
                    @if(!$readonly)
                        &nbsp;<span  class="text-xs delete cCriteriaDeleteButton"><span class="fa fa-trash" aria-hidden="true"></span></span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>