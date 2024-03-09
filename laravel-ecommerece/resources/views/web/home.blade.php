@extends('layouts.web-front')
@section('content')
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @foreach ($sliders as $slider)
                <li class="text-left">
                    <img src="{{ $slider->getFirstMediaurl('image') }}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="m-b-20"><strong>Welcome To <br> Thewayshop</strong></h1>
                                <p class="m-b-40">See how your users experience your website in realtime or view <br>
                                    trends to see any changes in performance over time.</p>
                                <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->
    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                @foreach (getCategories() as $categories)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="{{ $categories->getFirstMediaurl('thumbnail_image') }}"
                                alt="" style="height: 400px" />
                            <a class="btn hvr-hover" href="{{route('category.data',$categories->url_key)}}">{{ $categories->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->
    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".top-featured">Top featured</button>
                            <button data-filter=".best-seller">Best seller</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row special-list">
                @foreach ($products as $product)
                    
                    <div class="col-lg-3 col-md-6 special-grid best-seller">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="sale">Sale</p>
                                </div>
                                <img src="{{ $product->getFirstMediaurl('thumbnail_image') }}" class="img-fluid"
                                    alt="Image" style="height: 300px">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                    class="fas fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li>
                                                    <form action="{{ route('wishlist.store') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id ?? '' }}">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <button type="submit" class="btn hvr-hover"
                                                            style="color: #fff" id="wishlist_btn"
                                                            data-toggle="tooltip"
                                                            data-placement="right"><i
                                                                class="far fa-heart"></i> </button>
                                                    </form>
                                                </li>
                                    </ul>
                                    <a class="cart" href="{{route('cart',$product->url_key)}}">Add to Cart</a>
                                </div>
                            </div>
                            <div class="why-text">
                            <a class="btn hvr-hover" href="{{route('product.data',$product->url_key)}}">{{ $product->name }}</a>

                                {{-- <h4>{{route('product.data',$product->url_key)}} {{ $product->name }}</h4> --}}
                                <h5>₹{{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h5>{{ $products->links() }}</h5>
        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>latest blog</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach (getblock() as $block)
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <img class="img-fluid" src="{{ $block->getfirstMediaurl('image') }}" alt=""
                                    style="height: 400px" />
                            </div>
                            <div class="blog-content">
                                <div class="title-blog">
                                    <h3>{{ $block->title }}</h3>
                                    <p>{!! $block->description !!}</p>
                                </div>
                                <ul class="option-blog">
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i
                                                class="far fa-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                            title="Comments"><i class="far fa-comments"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog  -->


    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
