<div class="flex flex-wrap ">
    <div class="lg:w-1/4 pr-4 pl-4">@lang("messages.plz_city")</div>
    <div class="lg:w-3/4 pr-4 pl-4">
        <div class="flex flex-wrap -mr-1 -ml-1">
        <div class="mb-4 md:w-1/4 pr-4 pl-4">
          <label class="sr-only" for="zipcode">@lang('messages.zipcode')</label>
          <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="zipcode" name="zipcode" placeholder="@lang('messages.zipcode')" value="{{(isset($val_zip)?$val_zip:"")}}">
        </div>
        <div class="mb-4 md:w-3/4 pr-4 pl-4">
          <label class="sr-only" for="city">@lang('messages.city_location')</label>
          <div class="relative flex items-stretch w-full">
              <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="city" name="city" placeholder="@lang('messages.city_location')" value="{{(isset($val_city)?$val_city:"")}}">
              <span class="input-group-text"><i class="fa fa-edit" aria-hidden="true"></i></span>
          </div>
        </div>
        </div>
	 </div>   
</div>