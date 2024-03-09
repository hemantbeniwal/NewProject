<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        @guest
                        <li><a href="{{route('customer.create')}}">Sign Up</a></li>
                        <li><a href="{{route('customer.login')}}">Sign In</a></li>                            
                        @endguest
                        @auth
                        <li><a href="{{route('customer.profile')}}">My Account</a></li>           
                        <li><a href="{{(route('customer.logout'))}}">Log Out</a></li>           
                        @endauth
                        <li><a href="#">Our location</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>