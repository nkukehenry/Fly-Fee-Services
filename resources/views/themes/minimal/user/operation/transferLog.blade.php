@extends($theme.'layouts.app')
@section('title',trans($page_title))
@section('content')
    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container-fluid">
            <div class="row justify-content-between mx-lg-5">
                <div class="col-lg-12">
                    <div class=" overview mx-lg-5">
                        <div class="overview-list">
                            <div class="table-responsive">
                                <table class="table  table-striped table-bordered text-center" id="service-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Invoice')</th>
                                        <th scope="col">@lang('Recipient')</th>
                                        <th scope="col">@lang('Send Amount')</th>
                                        <th scope="col">@lang('Send At')</th>
                                        <th scope="col">@lang('Receive Amount')</th>
                                        <th scope="col">@lang('Receive At')</th>
                                        <th scope="col" class="text-center">@lang('Rate')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sendMoneys as $k => $data)
                                        <tr>
                                            <td data-label="@lang('SL')">{{loopIndex($sendMoneys) + $k}}</td>
                                            <td data-label="@lang('Invoice')">{{$data->invoice}}</td>
                                            <td data-label="@lang('Recipient')">{{($data->recipient_name) ??'N/A'}}</td>
                                            <td data-label="@lang('Send Amount')"
                                                class="font-weight-bold">{{getAmount($data->totalPay, config('basic.fraction_number'))}} @lang($data->send_curr)</td>
                                            <td data-label="@lang('Send At')">{{($data->paid_at)? dateTime($data->paid_at) : 'N/A'}}</td>
                                            <td data-label="@lang('Receive Amount')"
                                                class="font-weight-bold">{{getAmount($data->recipient_get_amount, config('basic.fraction_number'))}} @lang($data->receive_curr)</td>
                                            <td data-label="@lang('Receive At')">{{($data->received_at)? dateTime($data->received_at) : 'N/A'}}</td>
                                            <td data-label="@lang('Rate')"
                                                class="font-weight-bold">{{trans('1')}} {{$data->send_curr}} <i
                                                    class="fa fa-exchange-alt text-info"></i> {{getAmount($data->rate, config('basic.fraction_number'))}} @lang($data->receive_curr)
                                            </td>

                                            <td data-label="@lang('Status')">
                                                @if($data->status == 0 && $data->payment_status == 0)
                                                    <span
                                                        class="badge badge-warning p-2">{{trans('Information Need')}}</span>
                                                @elseif($data->status == 2 && $data->payment_status == 0)
                                                    <span class="badge badge-info p-2">{{trans('Please Pay')}}</span>
                                                @elseif($data->status == 3 || $data->payment_status == 2)
                                                    <span class="badge badge-danger p-2">{{trans('Cancelled')}}</span>
                                                @elseif($data->status == 1 && $data->payment_status == 1)
                                                    <span class="badge badge-success p-2">{{trans('Completed')}}</span>
                                                @elseif($data->status == 2 && $data->payment_status == 1)
                                                    <span class="badge badge-warning p-2">{{trans('Processing')}}</span>
                                                @elseif($data->status == 2 && $data->payment_status == 3)
                                                    <span class="badge badge-dark p-2">{{trans('Payment Hold')}}</span>
                                                @endif
                                            </td>
                                            <td data-label="@lang('Action')">

                                                @if($data->status == 0 && $data->payment_status == 0)
                                                <a href="{{route('user.sendMoney.action',[$data,'fillup'])}}"  class="btn btn-info ml-1 mb-1"
                                                        title="{{trans('Fill Up Form')}}"><i class="fa fa-edit"></i>
                                                </a>
                                                @elseif($data->status == 2 && $data->payment_status == 0)
                                                    <a href="{{route('user.sendMoney.action',[$data,'payment'])}}"  class="btn btn-success ml-1 mb-1"
                                                       title="{{trans('Pay Payment')}}"><i class="fa fa-hand-holding-usd"></i>
                                                    </a>
                                                    <a href="{{route('user.sendMoney.action',[$data,'details'])}}"  class="btn btn-primary ml-1 mb-1"
                                                       title="{{trans('Details')}}"><i class="fa fa-info-circle"></i>
                                                    </a>
                                                @elseif($data->status != 0)
                                                    <a href="{{route('user.sendMoney.action',[$data,'details'])}}"  class="btn btn-primary ml-1 mb-1"
                                                       title="{{trans('Details')}}"><i class="fa fa-info-circle"></i>
                                                    </a>
                                                @else
                                                    -
                                                @endif



                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>@lang('No Data Found')</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            {{ $sendMoneys->appends($_GET)->links($theme.'partials.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
