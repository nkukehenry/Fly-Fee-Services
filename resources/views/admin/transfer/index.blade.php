@extends('admin.layouts.app')
@section('title',trans($page_title))
@section('content')
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <form action="{{ route('admin.money-transfer.search') }}" method="get">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <input type="text" name="name" value="{{@request()->name}}" class="form-control"
                               placeholder="@lang('Email/ Username/ Invoice')">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">@lang('All Payment')</option>
                            <option value="1"
                                    @if(@request()->payment_status == '1') selected @endif>@lang('Complete Payment')</option>
                            <option value="2"
                                    @if(@request()->payment_status == '2') selected @endif>@lang('Cancelled Payment')</option>
                            <option value="3"
                                    @if(@request()->payment_status == '3') selected @endif>@lang('Pending Payment')</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date_time" id="datepicker"/>
                    </div>
                </div>


                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary"><i
                                class="fas fa-search"></i> @lang('Search')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('SL')</th>
                        <th scope="col">@lang('Invoice')</th>
                        <th scope="col">@lang('Username')</th>
                        <th scope="col">@lang('Send Amount')</th>
                        <th scope="col">@lang('Fee')</th>
                        <th scope="col">@lang('Total Payable')</th>
                        <th scope="col">@lang('Receive Amount')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('More')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sendMoneys as $k => $data)
                        <tr>
                            <td data-label="@lang('SL')"> {{loopIndex($sendMoneys) + $k}}</td>
                            <td data-label="@lang('Username')"
                                class="font-weight-bold text-uppercase">{{$data->invoice}}</td>
                            <td data-label="@lang('Invoice')"><a
                                    href="{{route('admin.user-edit', $data->user_id)}}"
                                    target="_blank">{{ optional($data->user)->username }}</a>
                            </td>

                            <td data-label="@lang('Send Amount')">{{getAmount($data->totalPay, config('basic.fraction_number'))}} @lang($data->send_curr)</td>
                            <td data-label="@lang('Fee')"
                                class="font-weight-bold">{{getAmount($data->fees, config('basic.fraction_number'))}} @lang($data->send_curr) </td>
                            <td data-label="@lang('Total Payable')"
                                class="text-success">{{ getAmount($data->totalBaseAmountPay, config('basic.fraction_number'))}} {{ trans($basic->currency) }}</td>
                            <td data-label="@lang('Receive Amount')"
                                class="font-weight-bold">{{ getAmount($data->recipient_get_amount, config('basic.fraction_number')) }} {{trans($data->receive_curr)}}</td>

                            <td data-label="@lang('Status')">

                                    @if($data->status == 0 && $data->payment_status == 0)
                                        <span class="badge badge-warning badge-pill">{{trans('Information Need')}}</span>
                                    @elseif($data->status == 2 && $data->payment_status == 0)
                                        <span class="badge badge-info badge-pill">{{trans('Not yet pay')}}</span>
                                    @elseif($data->status == 3 || $data->payment_status == 2)
                                        <span class="badge badge-danger badge-pill">{{trans('Cancelled')}}</span>
                                    @elseif($data->status == 1 && $data->payment_status == 1)
                                        <span class="badge badge-success badge-pill">{{trans('Completed')}}</span>
                                    @elseif($data->status == 2 && $data->payment_status == 1)
                                        <span class="badge badge-warning badge-pill">{{trans('Awaiting')}}</span>
                                    @elseif($data->status == 2 && $data->payment_status == 3)
                                        <span class="badge badge-dark badge-pill">{{trans('Sent a payment request')}}</span>
                                    @endif

                            </td>
                            <td data-label="@lang('More')">

                                <a href="{{route('admin.money-transfer.details',$data)}}" class="btn btn-primary btn-icon">
                                        <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <p class="text-dark">@lang('No Data Found')</p>
                            </td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{ $sendMoneys->appends($_GET)->links('partials.pagination') }}
            </div>
        </div>
    </div>




@endsection
@push('js')
    <script>

        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
@endpush

