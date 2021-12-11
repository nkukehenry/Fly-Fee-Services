@extends($theme.'layouts.app')
@section('title',trans($page_title))
@section('content')
    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">

            <form action="{{route('user.sendMoney.formData',$sendMoney)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row  flex-column-reverse flex-lg-row">

                    <div class="col-lg-7 ">
                        <div class="add-recipient-form-wrapper">
                            <div class="add-recipient-form error">
                                <div class="content-title">
                                    <h5>{{trans('Add Recipient')}}</h5>
                                </div>
                                @if(optional($sendMoney->provider)->services_form)
                                    @foreach(optional($sendMoney->provider)->services_form as $k => $v)
                                        @if($v->type == "text")
                                            <div class="form-group">
                                                <label
                                                    for="{{$k}}">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                        <span
                                                            class="text-danger">*</span>  @endif </label>
                                                <input type="text" name="{{$k}}" value="{{old($k)}}" id="{{$k}}">

                                                @error($k)
                                                    <div class="error-massage-alt ">
                                                        <span>{{trans($message)}}</span>
                                                    </div>
                                                @enderror

                                            </div>

                                        @elseif($v->type == "textarea")
                                            <div class="form-group">
                                                <label
                                                    for="{{$k}}">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                        <span
                                                            class="text-danger">*</span>  @endif </label>
                                                <textarea name="{{$k}}" id="{{$k}}" class="form-control" rows="5"
                                                          placeholder="{{trans('Type Here')}}">{{old($k)}}</textarea>
                                                @error($k)
                                                <div class="error-massage-alt ">
                                                    <span>{{trans($message)}}</span>
                                                </div>
                                                @enderror
                                            </div>
                                        @elseif($v->type == "file")
                                            <div class="form-group">
                                                <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                        <span class="text-danger">*</span>  @endif </label>

                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail "
                                                         data-trigger="fileinput">
                                                        <img class="w-150px "
                                                             src="{{ getFile(config('location.default')) }}"
                                                             alt="...">
                                                    </div>
                                                    <div
                                                        class="fileinput-preview fileinput-exists thumbnail wh-200-150 "></div>

                                                    <div class="img-input-div">
                                                                <span class="btn btn-success btn-file">
                                                                    <span
                                                                        class="fileinput-new "> @lang('Select') {{$v->field_level}}</span>
                                                                    <span
                                                                        class="fileinput-exists"> @lang('Change')</span>
                                                                    <input type="file" name="{{$k}}" value="{{ old($k) }}" accept="image/*"
                                                                           @if($v->validation == "required") required @endif>
                                                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput"> @lang('Remove')</a>
                                                    </div>

                                                </div>

                                                @error($k)
                                                <div class="error-massage-alt ">
                                                    <span>{{trans($message)}}</span>
                                                </div>
                                                @enderror
                                            </div>
                                        @endif

                                    @endforeach
                                @endif


                                <div class="form-group">
                                    <label for="recipient_name">{{trans('Recipient Name')}}</label>
                                    <input type="text" id="recipient_name" name="recipient_name" value="{{old('recipient_name')}}">
                                    @error('recipient_name')
                                    <div class="error-massage-alt text-danger">
                                        <span>{{trans($message)}}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient_contact_no">{{trans('Recipient Contact No.')}}</label>
                                    <input type="text" id="recipient_contact_no" name="recipient_contact_no" value="{{old('recipient_contact_no')}}">
                                    @error('recipient_contact_no')
                                    <div class="error-massage-alt text-danger">
                                        <span>{{trans($message)}}</span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="recipient_email">{{trans('Recipient Email Address')}}</label>
                                    <input type="email" id="recipient_email" name="recipient_email" value="{{old('recipient_email')}}">
                                    @error('recipient_email')
                                    <div class="error-massage-alt text-danger">
                                        <span>{{trans($message)}}</span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="reason-for-snding">
                                        <label for="select-reason">{{trans('Source Of Fund')}} <span
                                                class="text-danger">*</span></label>

                                        <select id="select-reason" name="fund_source">
                                            <option selected disabled>{{trans('Select One')}}</option>
                                            @foreach($sourceFunds as $item)
                                                <option value="{{$item->title}}" {{ old('fund_source', $sendMoney->fund_source) == $item->title ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>

                                        @error('fund_source')
                                        <div class="error-massage-alt text-danger">
                                            <span>{{trans($message)}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="select-bank">
                                        <label for="select-service">{{trans('Sending Purpose')}} <span
                                                class="text-danger">*</span></label>
                                        <select name="purpose" id="select-service">
                                            <option selected disabled>{{trans('Select One')}}</option>
                                            @foreach($sendingPurpose as $item)
                                                <option value="{{$item->title}}" {{ old('purpose', $sendMoney->purpose) == $item->title ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('purpose')
                                        <div class="error-massage-alt text-danger">
                                            <span>{{trans($message)}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="continue-button large-button">
                                    <button type="submit">{{trans('Continue')}}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5 ">
                        <div class=" overview mb-4">
                            <div class="overview-list">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="content-title">
                                        <h5>{{optional($sendMoney->service)->name}}</h5>
                                    </div>
                                    <div class="transection-between">
                                        {{trans($sendMoney->send_curr)}} - {{trans($sendMoney->receive_curr)}}
                                    </div>
                                </div>
                                <ul class="overview-inner">
                                    <li class="overview-item">
                                        <span>{{trans('Send Amount')}}</span>
                                        <span>{{getAmount($sendMoney->send_amount)}} {{trans($sendMoney->send_curr)}} </span>
                                    </li>
                                    <li class="overview-item">
                                        <span>{{trans('Fees')}}</span>
                                        <span> {{getAmount($sendMoney->fees)}} {{trans($sendMoney->send_curr)}}</span>
                                    </li>
                                    <li class="overview-item">
                                        <span>{{trans('Exchange rate')}}</span>
                                        <span>{{trans('1')}} {{trans($sendMoney->send_curr)}}  <i
                                                class="fa fa-exchange-alt"></i> {{getAmount($sendMoney->rate,config('basic.fraction_number'))}} {{trans($sendMoney->receive_curr)}} </span>
                                    </li>
                                </ul>

                                <div class="overview-item total-pay">
                                    <span>{{trans('You pay in total')}}</span>
                                    <span>{{getAmount($sendMoney->send_amount,config('basic.fraction_number'))}} {{trans($sendMoney->send_curr)}} </span>
                                </div>

                                <div class="overview-item total-pay">
                                    <span>{{trans('Your recipient gets')}}</span>
                                    <span>{{getAmount($sendMoney->recipient_get_amount,config('basic.fraction_number'))}} {{trans($sendMoney->receive_curr)}} </span>
                                </div>


                                <div class="get-promo">
                                    <div class="check-input">
                                        <label for="s1">{{trans('Get a promo code?')}}</label>
                                        <input id="s1" name="isPromo" type="checkbox" class="switch">
                                    </div>
                                    <div class="promo-input ">
                                        <div class="get-promo-form d-flex justify-content-between">
                                            <input type="text" id="promo" name="promo_code"
                                                   placeholder="Enter Promo Code"
                                                   autocomplete="off">
                                            <button class="apply-btn d-none">{{trans('Apply')}}</button>
                                        </div>

                                        @error('promo_code')
                                        <div class="error-massage-alt text-danger">
                                            <span>{{trans('Invalid promo code')}}</span>
                                        </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </section>'

@endsection


@push('css-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('extra-js')
    <script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush

@push('script')

    <script>
        'use strict';
        $(document).ready(function () {
            $('input[name=isPromo]').change(function () {
                $('.promo-input').removeClass('show');
                if (this.checked) {
                    $('.promo-input').addClass('show');
                } else {
                    $('.promo-input').removeClass('show');
                }
            });
        });
    </script>
@endpush
@push('style')
@endpush
