@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-12">

                    <div class=" search-log">
                        <div class="blog-content blog-content-card">
                            <div class="blog-content-main">
                                <div class="paragraph">
                                    @lang(@$description)
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--=======Privacy=======-->


@endsection
