@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection


@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">

            <form action="" method="post" enctype="multipart/form-data" class="preview-form">
                @csrf
                <div class="row justify-content-between align-items-center">

                    <div class="col-lg-12">
                        <div class="add-recipient-form-wrapper">
                            <div class="add-recipient-form error">
                                <div class="content-title text-center ">
                                    <h5>{{trans('Please follow the instruction below')}}</h5>
                                    <p class="mt-2 ">{{trans('You have requested to deposit')}}  <b class="text--base">{{getAmount($order->amount,config('basic.fraction_number'))}}
                                            {{$basic->currency}}</b> , {{trans('Please pay')}}
                                        <b class="text--base">{{getAmount($order->final_amount,config('basic.fraction_number'))}} {{$order->gateway_currency}}</b>  {{trans('for successful payment')}}
                                    </p>
									
									<p class="mt-2 ">{!! optional($order->gateway)->note !!}</p>
                                </div>
                                @if(optional($order->gateway)->parameters)
                                    @foreach($order->gateway->parameters as $k => $v)
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



                                <div class="continue-button large-button">
                                    <button type="submit">{{trans('Confirm Now')}}</button>
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





