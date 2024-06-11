<section id="wsus__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__banner_content">
                    <div class="row banner_slider">
                        @if ($homepage_section_banner_one && $homepage_section_banner_one->banner_one && $homepage_section_banner_one->banner_one->status == 1)
                            <a href="{{$homepage_section_banner_one->banner_one->banner_url}}" class="col-xl-12">
                                <img src="{{asset($homepage_section_banner_one->banner_one->banner_image)}}" class="img-fluid position-relative overflow-hidden lazyload" style="background-size: cover; background-position: center; height: auto; max-height: 300px;" alt="Banner Image">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
