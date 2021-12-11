@if(isset($contentDetails['help']))
    <section id="help" class="wow fadeInUp py-5" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="help-list mt-5">
                        @foreach($contentDetails['help'] as $k => $data)
                            <li class="help-item">
                                <div class="help-card media align-items-center">
                                    <div class="help-icon">
                                        <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="help icon" >
                                    </div>
                                    <div class="help-body">
                                        <div class="content-title">
                                            <h5>@lang(@$data->description->title)</h5>
                                        </div>
                                        <div class="paragraph">
                                            <p>@lang(@$data->description->short_description)</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif
