<html>
<head>
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}"/>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <style>

        /*@import url('https://fonts.googleapis.com/css?family=Open+Sans:300|PT+Serif:400,400i,700|Spectral+SC:300');*/
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300');

        html,
        body {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
        }

        /* SWIPER SETUP */

        .swiper-container {
            width: 100%;
            padding: 0 1em;
            height: 400px;
            box-sizing: border-box;
        }
        .swiper-slide {
            width: 256px;
            height: 360px;
        }

        .swiper-button-prev,
        .swiper-button-next {
            display: none;
        }

        @media (min-width: 480px) {
            .swiper-button-prev,
            .swiper-button-next {
                display: block;
            }
            .swiper-container {
                width: 90%;
                width: calc(100% - 96px);
                padding: 0 0 0 0;
            }
        }

        /* SWIPER OVERRIDES */

        .swiper-button-next,
        .swiper-button-prev {
            background-size: 16px 20px;
        }

        .swiper-pagination-bullet {
            width: 5px;
            height: 5px;
            opacity: 0.7;
        }
        .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet {
            margin: 0 6px;
        }
        .swiper-pagination-bullet-active {
            background-color: white;
        }

        .swiper-button-prev {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23000'%2F%3E%3C%2Fsvg%3E");
        }
        .swiper-button-next {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23000'%2F%3E%3C%2Fsvg%3E");
            right: 10px;
            left: auto;
        }

        /* CUSTOM LAYOUT */
        .item {
            font-size: 90%;
            background: white;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }
        .item .photo {
            height: 170px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            background-size: cover;
        }
        .item .category {
            background: rgba(128, 128, 128, 0.5);
            color: white;
            padding: .25rem .5rem;
        }
        .item .title {
            padding: 0;
            margin: 0;
            font-size: 133%;
            padding: 0 .5rem;
            margin: .25rem 0;
            font-weight: normal;
        }
        .item .desc {
            padding: 0 .5rem;
            margin: .25rem 0;
            line-height: 150%;
        }
        .item .footer {
            margin-top: auto;
        }
        .item .footer a.link:link,
        .item .footer a.link:active,
        .item .footer a.link:visited {
            color: red;
            text-decoration: none;
        }
        .item .footer a.link:hover {
            text-decoration: underline;
        }
        .item .footer .link {
            display: block;
            padding: .25rem .5rem;
        }

    </style>
</head>
<body>
<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($auctions as $auction)
        <div class="swiper-slide item">
            <div class="photo" style="background-image: url({{asset('storage/files/' .\App\Models\ObjectImage::getTitlePicture($auction->titlePictureID)."-h200.jpg")}});">
                <div class="category">@lang('messages.'.$auction->subType)</div>
            </div>
            <h2 class="title">{{$auction->title}}</h2>
            <p class="desc">{{$auction->street}} {{$auction->street_number}}<br/>{{$auction->zipcode}} {{$auction->city}}<br/>
            @lang('messages.'.$auction->subType)<br/>
                @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->estateSize])estateSize @endcomponent
                @if(in_array($auction->type,['','flat']))
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingAreaSize])livingAreaSize @endcomponent
                @endif
                @if(in_array($auction->type,['house']))
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>($auction->livingConstructionSize+$auction->livingAreaNetSize)])
                        livingTotalSize @endcomponent
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingAreaNetSize])livingAreaNetSize @endcomponent
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->livingConstructionSize])livingConstructionSize @endcomponent
                @endif
                @if(in_array($auction->type,['house','commercial','parking']))
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>($auction->workConstructionSize+$auction->workAreaNetSize)])workTotalSize @endcomponent
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->workAreaNetSize])workAreaNetSize @endcomponent
                    @component('components.outputs.dd_simple',["addonText"=>"m²","value"=>$auction->workConstructionSize])workConstructionSize @endcomponent
                @endif
                @if(in_array($auction->type,['house','flat']))
                    @component('components.outputs.dd_simple',["value"=>$auction->rooms])rooms @endcomponent
                @endif
            </p>
            <div class="footer"><a class="link" href="{{route('auction.detail',['name'=>$auction->name])}}" target="_top">Auktion ansehen</a></div>
        </div>
        @endforeach
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
</div>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>
<script>
    var s = new Swiper('.swiper-container', {
        direction: 'horizontal',
        spaceBetween: 38,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    });
</script>
</body>
</html>
