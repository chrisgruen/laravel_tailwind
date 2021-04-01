<div class="modal opacity-0 modal-object-dialog" tabindex="-1" role="dialog" id="odd_{{$groupID}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('messages.'.$groupID)</h4>
                <button type="button" data-group="{{$groupID}}"  class="absolute top-0 bottom-0 right-0 px-4 py-3 clearform" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{$slot}}
                @if(isset($add_field_auction))
                    <div id="add_detail">
                        @if($add_field_auction->type == 'house')
                            @component('components.inputs.fg_textAddon',["type"=>"number","notempty"=>"false", "addon2"=>"€","value"=>$add_field_auction->rentDepositCost,"form_group_row"=>true])rentDepositCost @endcomponent
                        @endif
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" data-group="{{$groupID}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-no-border clearform" data-dismiss="modal">@lang('messages.cancel')</button>
                <button type="button" id="{{$groupID}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default oddOkButton">@lang('messages.acceptOk')</button>
            </div>
        </div>
    </div>
</div>

@if(isset($add_field_auction))
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                @if($add_field_auction->rentDeposit != 'yes')
                    $('#add_detail').hide();
                @endif
            });

            $("#rentDeposit").change(function(){
                if($(this).val() == 'yes') {
                    $('#add_detail').show();
                } else {
                    $('#add_detail').hide();
                }
            });
        </script>
    @endpush
@endif