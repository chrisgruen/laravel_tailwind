<div class="flex flex-wrap " id="odc_{{$slot}}" data-odc="{{$slot}}">
    <label class="lg:w-1/4 pr-4 pl-4" for="">@lang('messages.'.$slot)</label>
    <div class="lg:w-3/4 pr-4 pl-4">
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-toggle="modal" data-target="#odd_{{$slot}}">@lang('messages.'.$slot) @lang('messages.set')</button>
        <div class="form-input-overview text-right" id="odco_{{$slot}}"></div>
        <input type="hidden" name="{{$slot}}" value="" id="{{$slot}}">
    </div>
</div>

<div class="modal opacity-0 " tabindex="-1" role="dialog" id="odd_{{$slot}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('messages.'.$slot)</h4>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="flex flex-wrap ">
                    <label class="md:w-1/4 pr-4 pl-4">@lang('messages.pleaseChoose')</label>
                    <div id="{{$slot}}" class="md:w-3/4 pr-4 pl-4">
                        <div class="mb-4 custom-control custom-checkbox">
                            <input  type="checkbox" name="securityService1[]" id="selfAssessment" class="custom-control-input" value="selfAssessment" @if(isset($values) && in_array('selfAssessment', $values)) checked @endif>
                            <label class="custom-control-label" for="selfAssessment">@lang('messages.selfAssessment')</label>
                        </div>
                        <div class="mb-4 custom-control custom-checkbox">
                            <input  type="checkbox" name="securityService1[]" id="proofofSalary" class="custom-control-input" value="proofofSalary" @if(isset($values) && in_array('proofofSalary', $values)) checked @endif>
                            <label class="custom-control-label" for="proofofSalary">@lang('messages.proofofSalary')</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" id="securatyOkButton" data-dismiss="modal">@lang('messages.acceptOk')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            updateSecurities();
        })

        $('#securatyOkButton').click(function () {
            updateSecurities()
        })

        function updateSecurities() {
            var sec_services = [];
            var html = '';

            $.each($("#securityService .custom-control-input:checked"), function(){
                var val = $(this).val();
                sec_services.push(val);
                if(val == 'selfAssessment') {
                    html +=  '@lang('messages.selfAssessment')<br />'
                }
                if(val == 'proofofSalary') {
                    html +=  '@lang('messages.proofofSalary')'
                }
            });

            $('#{{$slot}}').val(JSON.stringify(sec_services));
            $('#odco_{{$slot}}').html(html);
        }

    </script>
@endpush