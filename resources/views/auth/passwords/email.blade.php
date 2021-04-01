@extends('layouts.master')
@section('title', trans('messages.login'))
@section('header_pagetitle', trans('messages.login'))

@section('content')

    @if (session('status'))
        <div class="flex flex-wrap ">
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">{{ session('status') }}</div>
            </div>
        </div>
    @endif

    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
        <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Reset Password') }}</div>

        <div class="flex-auto p-6 no-border-top">

            <form method="POST" action="{{ route('password.reset') }}" novalidate>
                @csrf

                <div class="mb-4 flex flex-wrap ">
                    <label for="email" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right">{{ __('E-Mail Address') }}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input id="email" type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded{{ $errors->has('email') ? ' bg-red-700' : '' }}" name="email" value="{{ old('email') }}" novalidate>
                        @error('email')
                            <span class="hidden mt-1 text-sm text-red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="flex flex-wrap ">
                	<div  class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right"></div>
                	<div  class=" md:w-1/2 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right ">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default">@lang('auth.reset_pw_link')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
