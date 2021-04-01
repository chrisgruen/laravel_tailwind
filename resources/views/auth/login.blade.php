@extends('layouts.master')
@section('title', trans('messages.login'))
@section('header_pagetitle', trans('messages.login'))

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

    <div class="relative flex flex-col min-w-0 break-words bg-white border border-1 border-gray-300">
        <div class="py-3 px-6 mb-0 bg-gray-100 border-b-1 border-gray-300 text-gray-900">@lang('messages.pleaseLogIn')</div>
        <div class="flex-auto p-6 no-border-top">
            <form id="loginForm" action="{{ isset($url) ? $url : route('login')}}" method="post">
                @component('components.inputs.fg_email',["notempty"=>"true", "notemptyMessage"=>trans('messages.dataFvEmail'), "form_group_row"=>true, "form_layout_center" => true])email @endcomponent
                @component('components.inputs.fg_password',["notempty"=>"true", "notemptyMessage"=>trans('messages.pleaseEnterPassword'), "form_group_row"=>true, "form_layout_center" => true])password @endcomponent
                <div class="flex flex-wrap ">
                	<div  class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right"></div>
                	<div  class=" md:w-1/2 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right ">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default">@lang('messages.login')</button><br />
                        <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent text-xs" href="{{ route('password.email') }}">@lang('auth.forgot_password')</a>
                    </div>
                </div>
                {{ csrf_field() }}
        	</form>
        </div>
    </div>

@endsection
@push('scripts')
<script type="text/javascript">

</script>
@endpush