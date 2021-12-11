@if(isset($templates['family-support'][0]) && $familySupport = $templates['family-support'][0])

<section id="family-support" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300" style="background-image: linear-gradient(to right , rgba(56, 80, 129,0.95), rgba(56, 80, 129,0.95)), url({{getFile(config('location.template.path').@$familySupport->templateMedia()->image)}});">
    <div class="container">
        <div class="family-support-content">
            <div class="d-flex flex-column">
                <span>@lang($familySupport->description->title)</span>
                <span>@lang($familySupport->description->short_description)</span>
            </div>

        </div>
    </div>
</section>
@endif
