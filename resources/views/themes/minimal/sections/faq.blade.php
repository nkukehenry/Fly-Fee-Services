@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])

    <section id="faq" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="faq-wrapper">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-center">
                            <div class="section-title title-bar">
                                <h1>@lang(@$faq->description->title)</h1>
                            </div>
                        </div>

                        @if(isset($contentDetails['faq']))
                            <div id="questions">

                                @foreach($contentDetails['faq'] as $k => $data)
                                <div class="faq-card {{($k == 0) ? 'show':''}}">
                                    <div class="faq-card-header">
                                        <a href="#question{{$k}}" class="card-link" data-toggle="collapse">
                                            <span>@lang(@$data->description->title)</span>
                                            <i class="icofont-rounded-down"></i>
                                        </a>
                                    </div>
                                    <div class="collapse  {{($k == 0) ? 'show':''}}" id="question{{$k}}" data-parent="#questions">
                                        <div class="faq-card-body">
                                            <p>@lang(@$data->description->description) </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>




@endif
