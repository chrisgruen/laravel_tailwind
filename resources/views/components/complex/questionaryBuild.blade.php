<style>
    .dataHolder div.quItem:first-child button.up-button {
        display: none;
    }
    .dataHolder div.quItem:last-child button.down-button {
        display: none;
    }
</style>


<div class="mb-4 flex flex-wrap ">
    <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}"></label>
    <div class="lg:w-3/4 pr-4 pl-4">
        <input type="hidden" value="{{$value}}" name="{{$slot}}" id="{{$slot}}">
    </div>
</div>

<div class="mb-4 flex flex-wrap ">
    <div class="lg:w-1/4 pr-4 pl-4 label"><label>@lang('messages.'.$slot)</label></div>
    <div class="lg:w-3/4 pr-4 pl-4">
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded edit editButton" data-toggle="modal" data-target="#rd_{{$slot}}">@lang('messages.'.$slot.'_descr')</button>
        <div class="form-input-overview">
            <div id="dataDisplay_{{$slot}}"></div>
        </div>
    </div>
</div>

<div class="modal opacity-0 " tabindex="-1" role="dialog" id="rd_{{$slot}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('messages.criteriaCatalog')</h4>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="dataHolder_{{$slot}}" class="dataHolder">
                    @if(isset($value) && !empty(json_decode($value,true)))
                        @foreach(json_decode($value,true) as $key=>$entry)
                            @if(array_key_exists('question',$entry))
                                <div class="quItem">
                                    <div class="flex flex-wrap  mb-3 mt-3">
                                        <label class="lg:w-1/4 pr-4 pl-4">@lang('messages.question')</label>
                                        <div class="lg:w-3/4 pr-4 pl-4"><textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">{{$entry['question']}}</textarea></div>
                                    </div>
                                    <div class="flex flex-wrap  mt-3">
                                        <label class="lg:w-1/4 pr-4 pl-4">@lang('messages.correctAnswer')</label>
                                        <div class="lg:w-1/3 pr-4 pl-4">
                                            <div class="relative inline-flex align-middle btn-group-toggle" data-toggle="buttons">
                                                <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 {{($entry['correctAnswer']=="yes"?"active":"")}}">
                                                    <input type="radio" name="n_{{$key}}" autocomplete="off" value="yes" data-msg="@lang('messages.yes')" @if($entry['correctAnswer'] == "yes") checked="checked" @endif />@lang('messages.yes')
                                                </label>
                                                <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 {{($entry['correctAnswer']=="no"?"active":"")}} ">
                                                    <input type="radio" name="n_{{$key}}" autocomplete="off" value="no" data-msg="@lang('messages.no')" {{($entry['correctAnswer']=="no"?"checked=checked":"")}} />@lang('messages.no')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="lg:w-2/5 pr-4 pl-4 text-right">
                                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short up-button"><span class="fa fa-arrow-up" aria-hidden="true"></span></button>
                                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short down-button"><span class="fa fa-arrow-down" aria-hidden="true"></span></button>
                                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short qbDeleteButton"><span class="fa fa-trash" aria-hidden="true"></span></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex flex-wrap  dummy">
                            <div class="relative flex-grow max-w-full flex-1 px-4">@lang('messages.noCriterias')</div>
                        </div>
                    @endif
                </div>

                <hr/>
                <div class="flex flex-wrap  text-right">
                    <div class="relative flex-grow max-w-full flex-1 px-4">
                        <button  type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default pull-left " data-dismiss="modal">@lang('messages.cancel')</button>
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default pull-right qbAddButton_{{$slot}}">@lang('messages.addCriteria')</button>
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default pull-right" id="oddOkButton_{{$slot}}" data-holder="dataHolder_{{$slot}}" data-id="{{$slot}}" data-dismiss="modal">@lang('messages.saveCriteriaCatalog')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        var add_item = 1;
        $(document).ready(function () {
            $('#oddOkButton_{{$slot}}').click(function (e) {
                displayData(e.target)

            })
            $('.qbAddButton_{{$slot}}').click(function () {
                addItem_{{$slot}}();
                enableButtons_{{$slot}}();
            })
                                
        	displayData('#oddOkButton_{{$slot}}');
            enableButtons_{{$slot}}();
        });

        function displayData(group) {
            data = Array();
            html = "<div class='form-input-overview'>";
            $('#' + $(group).data('holder')).find('.quItem').each(function (a, b) {
                question = $(b).find('textarea').val();
                correctAnswer = $(b).find('input[type=radio]:checked').val();
                correctAnswerHtml = $(b).find('input[type=radio]:checked').data('msg');
                if(question.length > 3) {
                    data.push({question: question, correctAnswer: correctAnswer});
                    html += '<div>' + question + '<div class="float-right">' + correctAnswerHtml + '</div></div>';
                }

            });
            html += "</div>";

            $('#' + $(group).data('id')).val(JSON.stringify(data));

            url = '{{ route('marketing.ajaxSetConceptSettings') }}';
            val_rating_required = $("input[name='entranceLimitation']:checked").val();
            data = {"ratingMatrix": JSON.stringify(data), "auctionID": {{$auctionID}}, 'val_rating_required':val_rating_required};

            $.ajax({
                method: "POST",
                url: url,
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            }).done(function (data, status) {
            });

            $('#dataDisplay_' + $(group).data('id')).html(html);
        }

        function addItem_{{$slot}}() {
            add_item++;
            $('#dataHolder_{{$slot}} .dummy').remove();
            html =
                '<div id="quItem_'+ add_item+'" class="quItem">\n' +
                '	<div class="flex flex-wrap  mb-3 mt-3">\n' +
                '    	<label class="lg:w-1/4 pr-4 pl-4">@lang('messages.question')</label>\n' +
                '    	<div class="lg:w-3/4 pr-4 pl-4"><textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="ta_' + add_item + '" id="ta_' + add_item + '" ></textarea></div>\n' +
                '	</div>\n' +
                '	<div class="flex flex-wrap  mt-3">\n' +
                '    <label class="lg:w-1/4 pr-4 pl-4">@lang('messages.correctAnswer')</label>\n' +
                '    <div class="lg:w-1/3 pr-4 pl-4">\n' +
                '        <div class="relative inline-flex align-middle btn-group-toggle" data-toggle="buttons">\n' +
                '            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 active">\n' +
                '                <input type="radio" name="ne_' + add_item + '" id="ne_' + add_item + '_yes" value="yes" autocomplete="off" data-msg="@lang('messages.yes')" checked="checked"> @lang('messages.yes')\n' +
                '            </label>&nbsp;&nbsp;\n' +
                '            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">\n' +
                '                <input type="radio" name="ne_' + add_item + '" id="ne_' + add_item + '_no" value="no" autocomplete="off" data-msg="@lang('messages.no')"> @lang('messages.no')\n' +
                '            </label>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <div class="lg:w-2/5 pr-4 pl-4 text-right" data-toggle="buttons">\n' +
                '        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short up-button"><span class="fa fa-arrow-up" aria-hidden="true"></span></button>\n' +
                '        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short down-button"><span class="fa fa-arrow-down" aria-hidden="true"></span></button>\n' +
                '        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-short qbDeleteButton"><span class="fa fa-trash" aria-hidden="true"></span></button>\n' +
                '    	</div>\n' +
                '	</div>\n' +
                '</div>';
            html += '';
            $('#dataHolder_{{$slot}}').append(html);
        }

        function enableButtons_{{$slot}}() {
            $('.up-button').off().click(function () {
                $(this).parents(":eq(2)").insertBefore($(this).parents(":eq(2)").prev());
            });

            $('.down-button').off().click(function () {
                $(this).parents(":eq(2)").insertAfter($(this).parents(":eq(2)").next());
            });
            $('.qbDeleteButton').off().click(function () {
                $(this).parents(":eq(2)").remove();
            });
        }
    </script>
@endpush()