<br>
<div class="categories">
    <div class="container">

        <div class="card">
            <div class="col-md-3">
                <h5>ক্যাটেগরি</h5>
                <hr class="horizontal-line">
            </div>


            <div class="card-body">
                <div class="row">
                    @php($i=1)
                    @foreach($categories as $category)
                        <div class="col-md-2" style="padding-bottom: 15px;">
                            <a href="/product/category/{{$category->category_id}}">
                                <img class="img-thumbnail category-img" ng-src="/images/category/{{$category->category_image}}" height="100px">
                                <p class="card-title product-title">{{$category->category_name}}</p>
                            </a>
                        </div>

                        @if($i>=18)
                            @break
                        @endif

                        @php($i++)
                    @endforeach


                </div>
            </div>


        </div>

    </div>
</div>
