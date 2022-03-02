<nav class="navbar navbar-expand-lg navbar-light nav-bg px-3 py-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('website/images/beeptopay-logo.png') }}" class="img-fluid" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="mx-auto order-0">
                <a href="#" class="font_14 font-weight-bold text-a-black mr-5">HOW TO USE</a>
                <a href="#" class="font_14 font-weight-bold text-a-black">WHERE TO USE</a>
            </div>
            <div class="d-flex">
                @guest
                    <a href="{{ route('website.login') }}" class="login-btn mr-3">LOG IN</a>
                    <a href="{{ route('website.register') }}" class="btn-signup">SIGN UP</a>
                @endguest
                @auth
                    <a href="#" class="font_14 font-weight-bold text-a-black mr-5">WELCOME, {{ Auth::user()->name }}</a>
                    <a href="{{ route('website.logout') }}" class="login-btn mr-3">LOG OUT</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
