<nav class="navbar navbar-expand-lg navbar-light nav-bg px-3 py-3">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand" href="{{ route('website.login') }}">
                <img src="{{ asset('website/images/beeptopay-logo.png') }}" class="img-fluid" alt="" />
            </a>
        @endguest
        @auth
        <a class="navbar-brand" href="{{ route('website.dashboard') }}">
            <img src="{{ asset('website/images/beeptopay-logo.png') }}" class="img-fluid" alt="" />
        </a>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="mx-auto order-0">
                @auth
                    <a href="{{ route('website.dashboard') }}" class="font_14 font-weight-bold text-a-black mr-2">HOME</a>
                @endauth
                    <a href="javascript:;" class="font_14 font-weight-bold text-a-black mr-2">HOW TO USE</a>
                    <a href="javascript:;" class="font_14 font-weight-bold text-a-black mr-2">WHERE TO USE</a>
                @auth
                    <a href="{{ route('website.payment-pin') }}" class="font_14 font-weight-bold text-a-black mr-2">CHANGE PIN</a>
                    <a href="{{ route('website.change-password') }}" class="font_14 font-weight-bold text-a-black mr-2">CHANGE PASSWORD</a>
                    <a href="javascript:;" class="font_14 font-weight-bold text-a-black mr-2">PROFILE</a>
                @endauth
            </div>
            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('website.login') }}" class="login-btn mr-3">LOG IN</a>
                    <a href="{{ route('website.register') }}" class="btn-signup">SIGN UP</a>
                @endguest
                @auth
                    <a href="javascript:;" class="font_14 font-weight-bold text-a-black mr-5">WELCOME, {{ Auth::user()->name }}</a>
                    <a href="{{ route('website.logout') }}" class="login-btn mr-3">LOG OUT</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
