@extends($theme.'layouts.user')
@section('title', trans('Transaction'))
@section('content')


    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container-fluid ">
            <div class="row justify-content-center mx-lg-5">
                <div class="col-lg-12">
                    <div class=" overview mx-lg-5">
                        <div class="overview-list search-log">
                            <form action="{{route('user.transaction.search')}}" method="get">
                                <div class="row justify-content-between align-items-center mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="transaction_id"
                                                   value="{{@request()->transaction_id}}"
                                                   class="form-control form-control-lg"
                                                   placeholder="@lang('Search for Transaction ID')">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="remark" value="{{@request()->remark}}"
                                                   class="form-control form-control-lg"
                                                   placeholder="@lang('Remark')">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-lg" name="datetrx" id="datepicker"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-lg btn-block">
                                                <i class="fa fa-search"></i> @lang('Search')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mx-lg-5 mt-4">
                <div class="col-lg-12">
                    <div class=" overview mx-lg-5">
                        <div class="overview-list">

                            <div class="table-responsive">
                                <table class="table  table-striped table-bordered text-center" id="service-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('SL No.')</th>
                                        <th>@lang('Transaction ID')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Charge')</th>
                                        <th class="column-remark">@lang('Remark')</th>
                                        <th>@lang('Time')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td data-label="@lang('SL No.')">{{loopIndex($transactions) + $loop->index}}</td>
                                            <td data-label="@lang('Transaction ID')">@lang($transaction->trx_id)</td>
                                            <td data-label="@lang('Amount')">
                                        <span
                                            class="font-weight-bold text-{{($transaction->trx_type == "+") ? 'success': 'danger'}}"> {{getAmount($transaction->amount, config('basic.fraction_number'))}} {{trans(config('basic.currency'))}}</span>
                                            </td>

                                            <td data-label="@lang('Charge')">
                                        <span
                                            class="font-weight-bold ">{{getAmount($transaction->charge, config('basic.fraction_number'))}} {{trans(config('basic.currency_symbol'))}}</span>
                                            </td>
                                            <td data-label="@lang('Remark')"> @lang($transaction->remarks)</td>
                                            <td data-label="@lang('Time')">
                                                {{ dateTime($transaction->created_at, 'd M Y h:i A') }}
                                            </td>
                                        </tr>
                                    @empty

                                        <tr class="text-center">
                                            <td colspan="100%">{{trans('No Data Found!')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $transactions->appends($_GET)->links($theme.'partials.pagination') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
