@extends('admin.layouts.app')
@section('title',trans($page_title))
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('Transaction Information')}}

                            @if(adminAccessRoute(config('role.remittance_history.access.edit')))
                                @if($sendMoney->status == 2 && $sendMoney->payment_status == 1)
                                    <button  data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm float-right mb-2"><i class="fa fa-check-circle"></i> {{trans('Action')}}</button>
                                @elseif($sendMoney->status == 2 && $sendMoney->payment_status == 3)
                                    <button  data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm float-right mb-2"><i class="fa fa-check-circle"></i> {{trans('Action')}}</button>
                                @endif
                            @endif


                        </h4>
                        <hr>

                        <div class="p-4 border shadow-sm rounded">
                            <div class="row">
                                <div class="col-md-4 border-right">
                                    <ul class="list-style-none">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-info mr-2 text--site"></i> {{trans('Transaction')}}: <small class="float-right">{{dateTime($sendMoney->created_at)}}</small></span>

                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site"></i> {{trans('Invoice')}} : <span
                                                        class="font-weight-medium text-dark">{{$sendMoney->invoice}}</a></span></span>
                                        </li>

                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site"></i> {{trans('Service')}} : <span
                                                        class="font-weight-medium text-dark">{{optional($sendMoney->service)->name}}</a></span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site"></i> {{trans('Service Provider')}} : <span
                                                        class="font-weight-medium text-dark">{{optional($sendMoney->provider)->name}}</a></span></span>
                                        </li>


                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site"></i> {{trans('Send Amount')}} : <span>{{getAmount($sendMoney->send_amount, config('basic.fraction_number'))}} @lang($sendMoney->send_curr)</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i
                                                        class="icon-check mr-2 text--site"></i> {{trans('Fees')}} : <span>{{getAmount($sendMoney->fees, config('basic.fraction_number'))}} @lang($sendMoney->send_curr)</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span class="font-weight-bold text-dark"><i
                                                        class="icon-check mr-2 text--site"></i> {{trans('Total')}} : <span
                                                        class="font-weight-medium text-info">{{getAmount($sendMoney->payable_amount, config('basic.fraction_number'))}} @lang($sendMoney->send_curr)</span></span>
                                        </li>
                                        @if( 0 <$sendMoney->discount)
                                            <li class="my-3">
                                                    <span><i class="icon-check mr-2 text--site"></i> {{trans('Discount')}} : <span
                                                            class="font-weight-bold text-danger">- {{getAmount($sendMoney->discount, config('basic.fraction_number'))}} @lang($sendMoney->send_curr)</span> @if($sendMoney->promo_code)
                                                            <small class="pl-2 text-dark">{{trans('Promo Code')}} ({{$sendMoney->promo_code}})</small>@endif </span>
                                            </li>
                                        @endif

                                        <li class="my-3">
                                                <span class="font-weight-bold text-dark"><i
                                                        class="icon-check mr-2 text--site"></i> {{trans('Payable')}} : <span
                                                        class="font-weight-medium text-primary">{{getAmount($sendMoney->totalPay, config('basic.fraction_number'))}} @lang($sendMoney->send_curr)</span></span>
                                        </li>


                                        <li class="my-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-check mr-2 text--site"></i> {{trans('Receive Amount')}} : <span
                                                        class="font-weight-medium text-success">{{getAmount($sendMoney->recipient_get_amount, config('basic.fraction_number'))}} @lang($sendMoney->receive_curr)</span></span>
                                        </li>


                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site"></i> {{trans('Rate')}} : <span
                                                    class="font-weight-bold">{{trans('1')}} {{$sendMoney->send_curr}} <i
                                                        class="fa fa-exchange-alt text-info px-2"></i> {{getAmount($sendMoney->rate, config('basic.fraction_number'))}} @lang($sendMoney->receive_curr)</span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site"></i> {{trans('Status')}} :

                                                @if($sendMoney->status == 0 && $sendMoney->payment_status == 0)
                                                    <span
                                                        class="badge badge-warning badge-pill">{{trans('Information Need')}}</span>
                                                @elseif($sendMoney->status == 2 && $sendMoney->payment_status == 0)
                                                    <span
                                                        class="badge badge-info badge-pill">{{trans('Not yet pay')}}</span>
                                                @elseif($sendMoney->status == 3 || $sendMoney->payment_status == 2)
                                                    <span
                                                        class="badge badge-danger badge-pill">{{trans('Cancelled')}}</span>
                                                @elseif($sendMoney->status == 1 && $sendMoney->payment_status == 1)
                                                    <span
                                                        class="badge badge-success badge-pill">{{trans('Completed')}}</span>
                                                @elseif($sendMoney->status == 2 && $sendMoney->payment_status == 1)
                                                    <span
                                                        class="badge badge-warning badge-pill">{{trans('Awaiting')}}</span>
                                                @elseif($sendMoney->status == 2 && $sendMoney->payment_status == 3)
                                                    <span
                                                        class="badge badge-dark badge-pill">{{trans('Sent a payment request')}}</span>
                                                @endif
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site"></i> {{trans('Payment Status')}} :
                                                @if($sendMoney->payment_status == 1)
                                                    <span
                                                        class="badge badge-success badge-pill ">{{trans('Completed')}}</span>
                                                @elseif($sendMoney->payment_status == 2)
                                                    <span
                                                        class="badge badge-danger badge-pill">{{trans('Cancelled')}}</span>
                                                @elseif($sendMoney->payment_status == 3)
                                                    <span
                                                        class="badge badge-warning badge-pill">{{trans('Payment Pending')}}</span>
                                                @endif</span>
                                        </li>


                                        @if($sendMoney->paid_at)
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site"></i> {{trans('Paid At')}} : <span
                                                        class="font-weight-bold">{{dateTime($sendMoney->paid_at)}}</span></span>
                                        </li>
                                        @endif
                                        @if($sendMoney->received_at)
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site"></i> {{trans('Receive At')}} : <span
                                                        class="font-weight-bold">{{dateTime($sendMoney->received_at)}}</span></span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>



                                <div class="col-md-4 border-right">
                                    <ul class="list-style-none ">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="fa fa-hand-holding-usd mr-2 text-warning"></i> {{trans('Sender Payment Via')}}</span>
                                        </li>

                                        <li class="my-3 ">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Payment Trx ID')}} : <span class="font-weight-medium">{{optional($sendMoney->payment)->transaction}}</span></span>
                                        </li>
                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Payment Method')}} : <span class="font-weight-medium text-dark">{{optional(optional($sendMoney->payment)->gateway)->name}}</span></span>
                                        </li>
                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Amount')}} : <span class="font-weight-medium text-dark">{{getAmount(optional($sendMoney->payment)->amount, config('basic.fraction_number'))}} {{ $basic->currency }}</span></span>
                                        </li>
                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Charge')}} : <span class="font-weight-medium text-danger">{{getAmount(optional($sendMoney->payment)->charge, config('basic.fraction_number'))}} {{ $basic->currency }}</span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Payable')}} : <span class="font-weight-medium text-primary">{{getAmount(optional($sendMoney->payment)->final_amount, config('basic.fraction_number'))}} {{ $basic->currency }}</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-warning"></i> {{trans('Payment Status')}} :
                                                 @if(optional($sendMoney->payment)->status == 2)
                                                        <span class="badge badge-warning">@lang('Pending')</span>
                                                    @elseif(optional($sendMoney->payment)->status == 1)
                                                        <span class="badge badge-success">@lang('Approved')</span>
                                                    @elseif(optional($sendMoney->payment)->status == 3)
                                                        <span class="badge badge-danger">@lang('Rejected')</span>
                                                    @endif
                                            </span>
                                        </li>
                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text-warning"></i> {{trans('Payment Date')}} : <span class="font-weight-medium">{{dateTime(optional($sendMoney->payment)->created_at)}}</span></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 ">
                                    <ul class="list-style-none border-bottom">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-user mr-2 text-primary"></i> {{trans('Sender')}}:</span>
                                        </li>
                                        <li class="my-3">
                                                <span><i
                                                        class="icon-check mr-2 text-primary"></i> {{trans('Name')}} : <span
                                                        class="font-weight-bold"><a
                                                            href="{{route('admin.user-edit',$sendMoney->user_id)}}"
                                                            target="_blank"
                                                            class="text-primary d-inline-block">{{optional($sendMoney->user)->username}}</a></span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-primary"></i> {{trans('Email')}} : <span
                                                        class="font-weight-bold">{{optional($sendMoney->user)->email}}</span></span>
                                        </li>

                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-primary"></i> {{trans('Phone')}} : <span
                                                        class="font-weight-bold">{{optional($sendMoney->user)->phone}}</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-primary"></i> {{trans('Address')}} : <span
                                                        class="font-weight-bold">{{optional($sendMoney->user)->address}}</span></span>
                                        </li>
                                    </ul>
                                    <ul class="list-style-none mt-4">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-user mr-2 text-success"></i> {{trans('Recipient')}}:</span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-success"></i> {{trans("Family / Friend's  Name")}} : <span
                                                        class="font-weight-bold">{{$sendMoney->recipient_name}}</span></span>
                                        </li>

                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-success"></i> {{trans('Email')}} : <span
                                                        class="font-weight-bold">{{$sendMoney->recipient_email}}</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-success"></i> {{trans('Phone')}} : <span
                                                        class="font-weight-bold">{{$sendMoney->recipient_contact_no}}</span></span>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <div class="p-4 border shadow-sm rounded mt-4">
                            <h4 class="card-title"><i
                                    class="icon-info mr-2 text-primary"></i>{{optional($sendMoney->provider)->name}} {{trans('Information')}}
                            </h4>
                            <hr>

                            <div class="row mb-3">
                                <div class="col-md-5 ">
                                    <ul class="list-style-none">
                                        @if($sendMoney->user_information != null)
                                            @foreach($sendMoney->user_information as $k => $v)
                                                @if($v->type != 'file')
                                                    <li class="my-3">
                                                <span><i
                                                        class="icon-check mr-2 text-info"></i> {{camelToWord($k)}} : <span
                                                        class="font-weight-medium text-dark">{{$v->field_name}}</span></span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>


                                <div class="col-md-7 ">
                                    <div class="row">
                                        @if($sendMoney->user_information != null)
                                            @foreach($sendMoney->user_information as $k => $v)
                                                @if($v->type == 'file')
                                                    <div class="col-md-6 ">
                                                        <div class=" p-4 border shadow rounded mt-4">
                                                             <span>{{camelToWord($k)}} : <a href="{{route('admin.money-transfer.download',[encrypt($v->file_location."/|".$v->field_name)])}}" class="btn btn-primary btn-sm float-right mb-2"><i class="fa fa-download"></i></a><br>
                                                                 <span class="font-weight-medium text-dark">
                                                                <img src="{{getFile($v->file_location.'/'.$v->field_name)}} "
                                                             class="w-100" alt="">
                                                    </span></span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="p-4 border shadow-sm rounded mt-4">


                            <div class="row">
                                <div class="col-md-7 border-right">
                                    <ul class="list-style-none">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-bold text-dark"><i
                                                        class="icon-handbag mr-2 text-info"></i> {{trans('Source & Purpose')}}:</span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-info"></i> {{trans('Funding Source')}} : <span
                                                        class="font-weight-bold">{{$sendMoney->fund_source}}</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i
                                                        class="icon-check mr-2 text-info"></i> {{trans('Purpose')}} : <span
                                                        class="font-weight-bold">{{$sendMoney->purpose}}</span></span>
                                        </li>
                                    </ul>
                                </div>


                                <div class="col-md-5">
                                    <ul class="list-style-none">
                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-user-following mr-2 text-success"></i> {{trans('Admin Role')}}:</span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-success"></i> {{trans('Attempt by')}} : <span
                                                        class="font-weight-bold">{{optional($sendMoney->admin)->name}}</span></span>
                                        </li>
                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text-success"></i> {{trans('Admin Response')}} : <span
                                                        class="font-weight-medium text-dark">{{$sendMoney->admin_reply}}</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="myModalLabel">@lang('Confirmation')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <form role="form" method="POST"  action="{{route('admin.money-transfer.action',$sendMoney)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <p class="font-weight-medium">{{trans('Are you sure to change this?')}}</p>
                        <div class="form-group mt-3">
                            <label>{{trans('Message')}}</label>
                            <textarea name="admin_reply" id="admin_reply" class="form-control" rows="2">{{old('admin_reply')}}</textarea>
                            @error('admin_reply')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-primary" name="status"
                                    value="1">@lang('Complete')</button>
                            <button type="submit" class="btn btn-danger" name="status"
                                    value="3">@lang('Reject')</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
@push('js')
    @if ($errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
            Notiflix.Notify.Failure("{{ $error }}");
            @endforeach
        </script>
    @endif
@endpush
