@extends('layouts.master')
@section('title', trans('messages.search'))
@section('header_pagetitle', trans('messages.searchSubtitle'))

@section('content')
    <style>
        .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-no-suggestion { padding: 2px 5px;}
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: bold; color: #000; }
        .autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; background: #ececed; }
        #search_form {display: none}
        .form-control-sm {background-color: #fff}
        .input-group-text {font-size: inherit}
        #immolocation_count {font-size: 11px;}
    </style>

  <div id="typeButtons" class="btn-group-toggle mb-3 center-mobile" data-toggle="buttons">
      <label id="sale" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">
          <input type="radio" name="marketType" autocomplete="off" value="sale">@lang('messages.sale')
      </label>
      <label id="rent" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">
          <input type="radio" name="marketType" autocomplete="off" value="rent">@lang('messages.rent')
      </label>
      <label id="lease" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">
          <input type="radio" name="marketType" autocomplete="off" value="lease">@lang('messages.lease')
      </label>
      <label id="build_lease" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">
          <input type="radio" name="marketType" autocomplete="off" value="build_lease">@lang('messages.build_lease')
      </label>&nbsp;&nbsp;
  </div>

{{--
  <div id="search_form">@include('auction.searchForm')</div>
--}}
<div class="flex flex-wrap  mt-2 mb-0">
    <div class="relative flex-grow max-w-full flex-1 px-4 mb-0">
        <div id="response_save_search"></div>
    </div>
</div>

<div id="ajax-response" class="mt-2"></div>

@endsection
@push('scripts')

  <script>

  </script>
@endpush