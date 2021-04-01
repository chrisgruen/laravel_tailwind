@extends('layouts.master')
@section('title', trans('messages.registrationState'))
@section('header_pagetitle', trans('messages.registration'))

@section('content')
    <div class="flex flex-wrap ">
        <div class="relative flex-grow max-w-full flex-1 px-4">
            @if(count($errors) > 0)
                <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{--
        @include('partials.'.App::getLocale().'.registrationIntro')
	--}}
		<div class="card-w-full">
			<div class="relative flex flex-col content-center min-w-0 rounded break-words border bg-white border-1 border-gray-300">
				<div class="py-3 px-6 mb-0 bg-gray-100 border-b-1 border-gray-300 text-gray-900 uppercase">@lang('messages.privateOrBusiness')</div>
				<div class="flex-auto p-6">
					<p>@lang('messages.regQuestionCompany')</p>
                    <div class="relative inline-flex align-middle float-right mt-4" role="group" aria-label="split" id="ct-form">
                        <button type="button" id="ct-private" data-ct="private" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-no-border">
                            @lang('messages.private')
                        </button> &nbsp;&nbsp;
                        <button type="button" id="ct-company" data-ct="company" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-no-border">
                            @lang('messages.company' )
                        </button>
                    </div>
				</div>
			</div>			
		</div>
        
        
        

    <form action="{{ route('register') }}" id="inputForm" method="post">
        <input type="hidden" name="customerType" value="0" id="customerType">
        <div class="flex flex-wrap  hidden mt-5" id="user_details">
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">@lang('messages.personalData')</div>
                    <div class="flex-auto p-6">
                            @component('components.inputs.fg_text',['value'=>$user->company, 'form_group_row'=>true])company @endcomponent
                            @component('components.inputs.fg_text',['value'=>$user->firstname,"notempty"=>"true","notemptyMessage"=>trans('messages.dataFvFirstname'),'form_group_row'=>true])firstname @endcomponent
                            @component('components.inputs.fg_text',['value'=>$user->lastname,"notempty"=>"true","notemptyMessage"=>trans('messages.dataFvLastname'),'form_group_row'=>true])lastname @endcomponent
                            @component('components.inputs.fg_text',['value'=>$user->address,"notempty"=>"true","notemptyMessage"=>trans('messages.dataFvAddress'),'form_group_row'=>true])address @endcomponent
                         	
                         	<!-- PLZ/City -->
                         	@component('components.inputs.fg_locationForm',['val_city'=>$user->city, 'val_zip'=>$user->zipcode, "notempty"=>"true", 'form_group_row'=>true])zipcode @endcomponent
                         	<div class="mb-4 flex flex-wrap ">
                         		<label class="lg:w-1/4 pr-4 pl-4" for="checkZip"></label>
                         		<div class="lg:w-3/4 pr-4 pl-4"><input type="hidden" name="checkZip" /></div>
                         	</div>
                            
                            @component('components.inputs.fg_text',['value'=>$user->phonenumber,"notempty"=>"false",'form_group_row'=>true])phonenumber @endcomponent
                            @component('components.inputs.fg_text',['value'=>$user->mobilenumber,"notempty"=>"false",'form_group_row'=>true])mobilenumber @endcomponent
                            @component('components.inputs.fg_email',['value'=>$user->email,"notempty"=>"true","notemptyMessage"=>trans('messages.dataFvEmail'),'form_group_row'=>true])email @endcomponent
                            <p>@lang('passwords.password')</p>
                            @component('components.inputs.fg_password',["notempty"=>"true","notemptyMessage"=>trans('messages.dataFvPassword'),'form_group_row'=>true])password @endcomponent
                            @component('components.inputs.fg_passwordConfirm',['form_group_row'=>true])password_confirm @endcomponent
                    </div>
                </div>
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mt-4">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">@lang('messages.privacy')</div>
                    <div class="flex-auto p-6">
                        <div class="mb-4 relative block mb-2">
                            <input type="checkbox" class="absolute mt-1 -ml-6" id="agreeTerms" name="agreeTerms" data-fv-not-empty="true" data-fv-not-empty___message="@lang('messages.youHaveToAcceptPrivacy')">
                            <label class="text-gray-700 pl-6 mb-0" for="agreeTerms">
                                @lang('messages.iAgree') <a class="link-color" href="{{ route('content',["pageContent"=>"privacy"])}}" >@lang('messages.privacy')!</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap  mt-3">
                    <div class="relative flex-grow max-w-full flex-1 px-4 float-right">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default float-right">@lang('messages.registerProfile')</button>
                    </div>
                </div>
                {{ csrf_field() }}

            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
    
    </script>
@endpush