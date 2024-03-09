<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
    <div class="container">
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('images/logo.png')}}" class="logo"
                    alt=""></a>
        </div> 
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

                     @foreach (getCategory() as $category)
                        @if(getsubCategory($category->id)->count())
                             <li class="dropdown ">
                                        <a href="{{ route('category.data', $category->url_key) }}" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">{{{$category->name}}}</a>
                                     <ul class="dropdown-menu" role="menu">
                                          @foreach (getsubCategory($category->id) as $subcategory)                                      
                                                 <li><a href="{{ route('category.data', $subcategory->url_key) }}" class="dropdown megamenu-fw">{{{$subcategory->name}}}</a></li>
                                            @foreach (getsubsubCategory($subcategory->id) as $subsubCategory)
                                               <li><a href="{{ route('category.data', $subsubCategory->url_key) }}" class="nav-link dropdown-toggle arrow " data-toggle="dropdown">{{{$subsubCategory->name}}}</a></li>
                                             @endforeach
                                          @endforeach 
                                    </ul>
                               </li>
                        @else
                             <li class="nav-item"><a class="nav-link" href="{{ route('category.data', $category->url_key) }}">{{{$category->name }}}</a></li>
                             
                        @endif
                    @endforeach                  
                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact Us</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->

        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                <li class="side-menu"><a href="{{route('wishlist.list')}}">
                    <i class="fa fa-heart"></i>
                    <span class="badge">{{WishlistSummaryCount()}}</span>
                </a></li>
                <li class="side-menu"><a href="{{ route('cart') }}">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="badge">{{cartSummaryCount() }}</span>
                    </a></li>
            </ul>
        </div>
        <!-- End Atribute Navigation -->
    </div>
    <!-- Start Side Menu -->
    <div class="side">
        <a href="#" class="close-side"><i class="fa fa-times"></i></a>
        <li class="cart-box">
            <ul class="cart-list">
                <li>
                    <a href="#" class="photo"><img src="{{asset('images/img-pro-01.jpg')}}" class="cart-thumb"
                            alt="" /></a>
                    <h6><a href="#">Delica omtantur </a></h6>
                    <p>1x - <span class="price">$80.00</span></p>
                </li>
                <li>
                    <a href="#" class="photo"><img src="{{asset('images/img-pro-02.jpg')}}" class="cart-thumb"
                            alt="" /></a>
                    <h6><a href="#">Omnes ocurreret</a></h6>
                    <p>1x - <span class="price">$60.00</span></p>
                </li>
                <li>
                    <a href="#" class="photo"><img src="{{asset('images/img-pro-03.jpg')}}" class="cart-thumb"
                            alt="" /></a>
                    <h6><a href="#">Agam facilisis</a></h6>
                    <p>1x - <span class="price">$40.00</span></p>
                </li>
                <li class="total">
                    <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                    <span class="float-right"><strong>Total</strong>: $180.00</span>
                </li>
            </ul>
        </li>
    </div>
    <!-- End Side Menu -->
</nav>