@if(isset($form_group_row))
    <div class="mb-4 flex flex-wrap ">
        <label class="lg:w-1/4 pr-4 pl-4" for="{{$slot}}">{{(isset($lable_name)?$lable_name:trans('messages.'.$slot))}}</label>
        <div class="lg:w-3/4 pr-4 pl-4">
            <div class="relative flex items-stretch w-full date">
                <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="{{$id}}" name="{{$slot}}" placeholder="@lang('messages.'.$slot)"
                       data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">
                <div class="input-group-append">
                    <label for="{{$slot}}_id" class="input-group-text"><i class="fa fa-calendar"></i></label>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="mb-4">
        <label for="{{$slot}}">{{(isset($lable_name)?$lable_name:'No')}}</label>
        <div class="relative flex items-stretch w-full date">
            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="{{$slot}}" name="{{$slot}}" placeholder="@lang('messages.'.$slot)"
                   data-fv-not-empty="{{(isset($notempty)?$notempty:"false")}}">
            <div class="input-group-append">
                <label for="{{$slot}}_id" class="input-group-text"><i class="fa fa-calendar"></i></label>
            </div>
        </div>
    </div>
@endif

@push('scripts')
<script>
	$(document).ready(function () {
		@if(isset($id))
			$('#{{$id}}').datetimepicker({
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
				format:'d.m.Y H:i',
				@if(isset($value))
					value:'{{$value}}',
				@else
					value:new Date(),
				@endif
				onChangeDateTime:function(dp,$input){
					@if(isset($callback) && strlen($callback) !== 0)
						if (!window['stopPropagation'])
							window['{{$callback}}']('{{$id}}');
					@endif
				}
			});
		@endif
	});
</script>
@endpush