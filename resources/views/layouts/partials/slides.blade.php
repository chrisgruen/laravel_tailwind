<div  id="slideContainer">

    <div id="slider-control" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/slides/slide_home.jpg')}}" class="block w-full" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_municipal.jpg')}}" class="block w-full" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_customer.jpg')}}" class="block w-full" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/slides/slide_special.jpg')}}" class="block w-full" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#slider-control" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider-control" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="modal opacity-0" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class=" ">
                    <div id="videoFrame"></div>
                    <!--
                    <iframe id="videoFrame" class="" src="https://www.youtube.com/embed/yvveTYDjKZQ?rel=0&amp;controls=0&amp;showinfo=0?enablejsapi=1&origin=http://relube.peinhardt.it" frameborder="0"
                            allowfullscreen></iframe>
                            -->
                </div>
            </div>
            <div class="modal-footer">
                <button id="stopButton" type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </div>
    </div>
</div>
