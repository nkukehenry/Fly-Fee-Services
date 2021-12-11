@extends($theme.'layouts.user')
@section('title',trans('Dashboard'))
@section('content')



    <section class="privacy pt-100 pb-100 section--bg overflow-hidden">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="card-counter primary">
                        <i class="las la-wallet"></i>
                        <span
                            class="count-numbers">{{trans(config('basic.currency_symbol'))}}{{getAmount($walletBalance)}}</span>
                        <span class="count-name">{{trans('Balance')}}</span>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card-counter success">
                        <i class="las la-money-bill"></i>
                        <span
                            class="count-numbers">{{trans(config('basic.currency_symbol'))}}{{getAmount($totalDeposit)}}</span>
                        <span class="count-name">{{trans('Total Deposit')}}</span>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card-counter liberty">
                        <i class="la la-ticket"></i>
                        <span class="count-numbers">{{$ticket}}</span>
                        <span class="count-name">{{trans('Support Ticket')}}</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection


@push('script')
@endpush
