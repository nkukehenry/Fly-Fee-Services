@extends($theme.'layouts.user')
@section('title', 'Warning')
@section('content')


    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-8">

                        <div class="card secbg">
                            <div class="card-body ">

                                <h1 class="text-center text-warning mt-5"><i
                                        class="fa fa-warning"></i>
                                    Warning
                                </h1>
                                <h4 class="text-center">Uh-ho! We are unable to process your Payment by this method.
                                    <br>This method is under construction!!
                                </h4>
                                <br>
                                <h4 class="text-center">Select <b>bkash</b> as your payment method.</h4>
                                <div class="col-md-8 col-md-offset-2">


                                    <div class="panel panel-info">
                                        <div class="panel-body">

                                            <div class="text-center">
                                                <a href="{{ route('addFund',["bkash",session()->get('id')]) }}">
                                                    <img src="{{ asset('assets/upload/logo/bkash.png') }}" class="w-50">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection

@push('script')
@endpush
