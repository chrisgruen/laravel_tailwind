<div class="modal opacity-0 lights-slot" tabindex="-1" role="dialog" id="modal-slot">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4></div>
            <div class="modal-body">
                <div class="lights"><span class="light"></span></div>
                <p><strong><i class="fa fa-exclamation-circle"></i>@lang('messages.biddingModalHeader'.$slot)</strong></p>
                <p>@lang('messages.biddingModalText'.$slot)</p></div>
            <div class="modal-footer">
                <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default bg-blue-600 text-white hover:bg-blue-600" data-dismiss="modal">@lang('messages.ok')</button>
            </div>
        </div>
    </div>
</div>