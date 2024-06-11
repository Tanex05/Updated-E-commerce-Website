<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                @if(isset($homepage_section_banner_four->banner_one) && isset($homepage_section_banner_four->banner_one->status) && $homepage_section_banner_four->banner_one->status == 1)
                    <a href="{{ $homepage_section_banner_four->banner_one->banner_url }}">
                        <img class="lazyload img-fluid rounded mx-auto d-block" style="max-width: 100%; height: auto;" data-src="{{ asset($homepage_section_banner_four->banner_one->banner_image) }}" alt="">
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
