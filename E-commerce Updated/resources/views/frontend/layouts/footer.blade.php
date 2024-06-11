@php
    $footerInfo = Cache::rememberForever('footer_info', function(){
            return \App\Models\FooterInfo::first();
    });
    $footerSocials = Cache::rememberForever('footer_socials', function(){
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridTwoLinks = Cache::rememberForever('footer_grid_two', function(){
        return \App\Models\FooterGridTwo::where('status', 1)->get();
    });
    $footerTitle = \App\Models\FooterTitle::first();
    $footerGridThreeLinks =Cache::rememberForever('footer_grid_three', function(){
        return \App\Models\FooterGridThree::where('status', 1)->get();
    });
@endphp
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="wsus__footer_content">
                    @isset($footerInfo->logo)
                        <a class="wsus__footer_2_logo" href="{{url('/')}}">
                            <img src="{{asset($footerInfo->logo)}}" alt="logo">
                        </a>
                    @endisset
                    @isset($footerInfo->phone)
                        <a class="action" href="callto:{{$footerInfo->phone}}"><i class="fas fa-phone-alt"></i>{{$footerInfo->phone}}</a>
                    @endisset
                    @isset($footerInfo->email)
                        <a class="action" href="mailto:{{$footerInfo->email}}"><i class="far fa-envelope"></i>{{$footerInfo->email}}</a>
                    @endisset
                    @isset($footerInfo->address)
                        <p><i class="fal fa-map-marker-alt"></i> {{$footerInfo->address}}</p>
                    @endisset
                    <ul class="wsus__footer_social">
                        @foreach ($footerSocials as $link)
                        <li><a class="behance" href="{{$link->url}}"><i class="{{$link->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6">
                <div class="wsus__footer_content">
                    @isset($footerTitle->footer_grid_two_title)
                        <h5>{{$footerTitle->footer_grid_two_title}}</h5>
                        <ul class="wsus__footer_menu">
                            @foreach ($footerGridTwoLinks as $link)
                                <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                            @endforeach
                        </ul>
                    @endisset
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6">
                <div class="wsus__footer_content">
                    @isset($footerTitle->footer_grid_three_title)
                        <h5>{{$footerTitle->footer_grid_three_title}}</h5>
                        <ul class="wsus__footer_menu">
                            @foreach ($footerGridThreeLinks as $link)
                                <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                            @endforeach
                        </ul>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        @isset($footerInfo->copyright)
                            <p>{{$footerInfo->copyright}}</p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


