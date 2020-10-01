<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <div class="row">
                    <div class="col-md">

                        <div class="card bg-light mb-3">
                            <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i>
                                ক্যাটেগরি
                            </div>
                            <ul class="list-group category-list">

                                @php($i=1)
                                @foreach($categories as $category)
                                    <li class="list-group-item"><a
                                                href="/product/category/{{$category->category_id}}">- {{$category->category_name}}</a>
                                    </li>
                                    @if($i>=4)
                                        @break
                                    @endif

                                    @php($i++)
                                @endforeach

                                <li class="list-group-item"><a
                                            href="/categories">- সকল ক্যাটেগরি</a>
                                </li>

                            </ul>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div id="top-slide" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#top-slide" data-slide-to="0" class="active"></li>
                        <li data-target="#top-slide" data-slide-to="1"></li>
                        <li data-target="#top-slide" data-slide-to="2"></li>
                    </ul>

                    <!-- The slideshow -->
                    @if(!empty($sliders))
                        <div class="carousel-inner">

                            @for($i=1;$i<=1;$i++)
                                <div class="carousel-item active">
                                    <img src="/images/slider/{{$sliders[0]->slider_image}}" alt="Los Angeles"
                                         width="1100"
                                         height="200px">
                                </div>
                            @endfor

                            @php($i=1)
                            @foreach($sliders as $slider)
                                @if($i>1)
                                    <div class="carousel-item">
                                        <img src="/images/slider/{{$slider->slider_image}}" alt="Los Angeles"
                                             width="1100"
                                             height="200px">
                                    </div>
                                @endif
                                @php($i++)
                            @endforeach
                        </div>
                @endif

                <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#top-slide" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#top-slide" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>

        </div>


    </div>
</div>
