<div class="flex flex-wrap " id="odc_{{$slot}}" data-odc="{{$slot}}">
    <label class="lg:w-1/4 pr-4 pl-4" for="">@lang('messages.'.$slot)</label>
    <div class="lg:w-3/4 pr-4 pl-4">
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-toggle="modal" data-target="#odd_{{$slot}}">@lang('messages.'.$slot) @lang('messages.set')</button>
        <div class="form-input-overview text-left mt-2" id="odco_{{$slot}}"></div>
        <input type="hidden" name="{{$slot}}" value="" id="{{$slot}}">
    </div>
</div>

@php $app_type = isset($value->type) ? $value->type : ''; @endphp

<div class="modal opacity-0 " tabindex="-1" role="dialog" id="odd_{{$slot}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('messages.'.$slot)</h4>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div id="typeButtons" class="flex flex-wrap ">
                    <div class="lg:w-1/3 pr-4 pl-4">
                        <div id="fixed" class="relative flex items-stretch w-full custom-radio">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" class="custom-radio-input appointmentType" name="appointmentType" aria-label="fixed" value="fixed" {{(isset($value) && isset($value->type) &&$value->type=="fixed"?'checked':"")}}>
                                </div>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded show-only-input" aria-label="fixed" value="@lang('messages.specifyAppointment')">
                        </div>
                    </div>
                    <div class="lg:w-1/3 pr-4 pl-4">
                        <div id="arranged" class="relative flex items-stretch w-full custom-radio">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" class="custom-radio-input appointmentType" name="appointmentType" aria-label="arranged" value="arranged" {{(isset($value) && isset($value->type) &&$value->type=="arranged"?'checked':"")}}>
                                </div>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded show-only-input" aria-label="arranged" value="@lang('messages.onlyArranged')">
                        </div>
                    </div>
                    <div class="lg:w-1/3 pr-4 pl-4">
                        <div id="anyTime" class="relative flex items-stretch w-full custom-radio">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" class="custom-radio-input appointmentType" name="appointmentType" aria-label="anyTime" value="anyTime" {{(isset($value) && isset($value->type) &&$value->type=="anyTime"?'checked':"")}}>
                                </div>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded show-only-input" aria-label="anyTime" value="@lang('messages.anyAppointment')">
                        </div>
                    </div>
                </div>

                {{--
                <div class="flex flex-wrap ">
                    <label class="md:w-1/4 pr-4 pl-4">@lang('messages.pleaseChoose')</label>
                    <div class="md:w-3/4 pr-4 pl-4">
                        <div id="typeButtons" class="relative inline-flex align-middle btn-group-toggle" data-toggle="buttons">
                            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 {{(isset($value) && isset($value->type) && $value->type=="fixed"?'active':"")}}" data-type="fixed">
                                <input type="radio" name="appointmentType" autocomplete="off" value="fixed" {{(isset($value) && isset($value->type) &&$value->type=="fixed"?'checked':"")}}>@lang('messages.specifyAppointment')
                            </label>&nbsp;&nbsp;
                            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 {{(isset($value) && isset($value->type) && $value->type=="arranged"?'active':"")}}" data-type="arranged">
                                <input type="radio" name="appointmentType" autocomplete="off" value="arranged" {{(isset($value) && isset($value->type) && $value->type=="arranged"?'checked':"")}}> @lang('messages.onlyArranged')
                            </label> &nbsp;
                            <label class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 {{(isset($value) && isset($value->type) && $value->type=="anyTime"?'active':"")}}" data-type="arrangedd">
                                <input type="radio" name="appointmentType" autocomplete="off" value="anyTime" {{(isset($value) && isset($value->type) && $value->type=="anyTime"?'checked':"")}}> @lang('messages.anyAppointment')
                            </label>
                        </div>
                    </div>
                </div>
                --}}

                <div class="flex flex-wrap  mt-4 showdates">
                    <label class="md:w-1/4 pr-4 pl-4">Termine</label>
                    <div class="md:w-2/5 pr-4 pl-4">
                        <div class="appointmentDates">
                            @if(isset($value->dates))
                                @foreach($value->dates as $date)
                                    <div class="element mt-2">
                                        <input type="text" name="appointmentDate[]" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded app_datepicker" placeholder="@lang('messages.newAppointment')" value="{{$date}}" />
                                    </div>
                                @endforeach
                            @else
                                <div class="element mt-2">
                                    <input type="text" name="appointmentDate[]" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded app_datepicker" placeholder="@lang('messages.newAppointment')" value="" />
                                </div>
                            @endif
                            <div class="add_element"></div>
                            <div class="buttons mt-3">
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs  clone">@lang('messages.addAppointment')</button>
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs  remove">@lang('messages.removeAppointment')</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" id="appointmentOkButton" data-dismiss="modal">@lang('messages.acceptOk')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        var dataKeeper = {type: false, dates: []};
        var app_type = "{{$app_type}}";

        $(document).ready(function () {

			if (app_type != 'fixed') {
				 $('.showdates').hide();
			}
            updateDates();

            $(".custom-radio").click(function(){
                id = $(this).attr('id');
                $('#'+id + ' .appointmentType').prop("checked", true);
                if (id == "fixed") {
                    $('.showdates').show();
                } else {
                    $('.showdates').hide();
                }
            });

            $('#appointmentOkButton').click(function () {
                updateDates();
            })

            $('#appointmentDates .appointmentDeleteButton').off().click(function () {
                $(this).parent('li').remove();
            });
        });


        function updateDates() {
            dataKeeper.type = $('input[name=appointmentType]:checked').val();
            dataKeeper.dates = [];
            $('.appointmentDates input').each(function (key, val) {
                if($(this).val() && $(this).val() != 'noch keine Termine') {
                    dataKeeper.dates.push($(this).val() + ' Uhr');
                } else {
                    dataKeeper.dates.push('keine Angaben');
                }
            });
            html = '';
            if (dataKeeper.type == "fixed") {
                $(dataKeeper.dates).each(function (key, val) {
                    html += val + '<br/>'
                })
            } else if(dataKeeper.type == "anyTime") {
                html += '@lang('messages.anyAppointment')'
            } else if(dataKeeper.type == "arranged") {
                html += '@lang('messages.onlyArranged')'
            }
            else {
                html += '@lang('messages.na')'
            }
            $('#odco_{{$slot}}').html(html);
        }


        $('.appointmentDates').on('click', '.clone', function() {
            $('.clone').closest('.appointmentDates').find('.element').first().clone().appendTo('.add_element');
            var date = $(".app_datepicker").val();
            if(date != '' && date != 'noch keine Termine') {
                $('.clone').closest('.appointmentDates').find('.app_datepicker').removeClass('appointmentDates').datetimepicker({
                	i18n:{
                        de:{
                         months:[
                          'Januar','Februar','März','April',
                          'Mai','Juni','Juli','August',
                          'September','Oktober','November','Dezember',
                         ],
                         dayOfWeek:[
                          "So.", "Mo", "Di", "Mi", 
                          "Do", "Fr", "Sa.",
                         ]
                        }
                       },
                       dayOfWeekStart: 1,
                       format:'d.m.Y H:i'                   
                });
            } else {
                //alert("@lang('messages.date_empty')");
                var remove = $('.remove').closest('.appointmentDates').find('.element').not(':first').last().remove();
            }
        })

        $('.appointmentDates').on('click', '.remove', function() {
            var remove = $('.remove').closest('.appointmentDates').find('.element').not(':first').last().remove();
            if(remove.length == 0) {
                $('.app_datepicker').val('');
            }
        });

        $('.app_datepicker').datetimepicker({
        	i18n:{
                de:{
                 months:[
                  'Januar','Februar','März','April',
                  'Mai','Juni','Juli','August',
                  'September','Oktober','November','Dezember',
                 ],
                 dayOfWeek:[
                  "So.", "Mo", "Di", "Mi", 
                  "Do", "Fr", "Sa.",
                 ]
                }
               },
               dayOfWeekStart: 1,
               format:'d.m.Y H:i'
        });

    </script>
@endpush