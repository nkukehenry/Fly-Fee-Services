@if(!request()->routeIs('home'))
    <section id="send-money-banner" style="background-image: linear-gradient(to right , rgba(56, 80, 129,0.95), rgba(56, 80, 129,0.95)), url({{getFile(config('location.logo.path').'background_image.jpg') ? : 0}});">
        <div class="container">
            <div class="page-banner-content  d-flex justify-content-center align-items-center flex-column">
                <div class="banner-heading">
                    <h1 class="text-center text-uppercase">@yield('title')</h1>
                </div>
            </div>
        </div>
    </section>
@endif
