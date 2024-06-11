@if($sliders->isNotEmpty())
    <section id="wsus__banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__banner_content">
                        <div class="row banner_slider">
                            @foreach ($sliders as $slider)
                                <div class="col-xl-12">
                                    <div class="wsus__single_slider" style="background-image: url('{{ $slider->banner }}'); background-size: cover; background-position: center;">
                                        <div class="wsus__single_slider_text">
                                            <h3>{!! $slider->type !!}</h3>
                                            <h1>{!! $slider->title !!}</h1>
                                            <h6>{!! $slider->sub_description !!}</h6>
                                            <a class="common_btn" href="{{ $slider->btn_url }}">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
