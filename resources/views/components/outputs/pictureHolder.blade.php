@if(!$pictures->isEmpty())
    <div class="pictureHolder flex flex-wrap ">
        <div class="flex flex-row flex-wrap">
        @if($pdf == true )
            @foreach($pictures as $picture)
                <div class="oIContainer flex flex-col text-center">
                    <a href="{{asset('storage/files/' .$picture->filename."-orig.pdf")}}" target="_blank">                 
                    @if(file_exists('storage/images/'.$picture->filename.'-h200.jpg'))
                        <img class="max-w-full h-auto border-1 border-gray-200 rounded p-1" src="{{asset('storage/images/' .$picture->filename."-h200.jpg")}}" alt="thumb-img">
                    @else
                    	<img class="max-w-full h-auto border-1 border-gray-200 rounded p-1" src="{{asset('img/pdf.png')}}" width="100" alt="thumb-img">
                	@endif
                    </a>
                    <div class="caption pdf-caption-short" data-toggle="tooltip" title="{{$picture->name}}">{{$picture->name}}</div>
                </div>
            @endforeach
            @else
                @foreach($pictures as $picture)
                    <div class="oIContainer flex flex-col text-center">
                        <a href="{{asset('storage/images/' .$picture->filename."-w840.jpg")}}" data-toggle="lightbox" target="_blank">
                            <img class="max-w-full h-auto border-1 border-gray-200 rounded p-1" src="{{asset('storage/images/' .$picture->filename."-h200.jpg")}}" width="100%" alt="thumb-img">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@else
    <div>@lang('messages.na')</div>
@endif

{{--
<div class="sm:w-1/2 pr-4 pl-4 md:w-1/3 pr-4 pl-4">
    <div class="thumbnail objectImage">
        <div class="oIContainer"><a href="{{asset('storage/files/' .$picture->filename."-orig.pdf")}}" target="_blank"><img
                        src="{{asset('storage/files/' .$picture->filename."-h200.jpg")}}"/></a></div>
        <div class="caption" data-toggle="tooltip" title="{{$picture->name}}">{{$picture->name}}</div>
    </div>
</div>
--}}