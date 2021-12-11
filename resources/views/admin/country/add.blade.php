@extends('admin.layouts.app')
@section('title',trans($page_title))
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
                <div class="card-body">
                    <div class="media mb-4 justify-content-end">
                        <a href="{{route('admin.country')}}" class="btn btn-sm  btn-primary mr-2">
                            <span><i class="fas fa-eye"></i> @lang('Country List')</span>
                        </a>
                    </div>

                    <form method="post" action=""
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3 col-6">
                                <label>{{trans('Continent')}}</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="continent_id"
                                        required="">
                                    <option disabled selected>@lang("Select Continent")</option>
                                    @foreach($continents as $item)
                                        <option
                                            value="{{ $item->id }}" {{ old('continent_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>


                                @error('continent_id')
                                <span class="text-danger d-block mt-3">{{ trans($message)  }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 col-6">
                                <label>{{trans('Country Name')}}</label>
                                <input type="text" class="form-control"
                                       name="name"
                                       value="{{ old('name') }}" >
                                @error('name')
                                <span class="text-danger">{{ trans($message)  }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 col-6">
                                <label>{{trans('Currency Code')}}</label>
                                <input type="text" class="form-control currency_code"
                                       name="code"
                                       value="{{ old('code') }}" >
                                @error('code')
                                <span class="text-danger">{{ trans($message)  }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 col-6">
                                <label>{{trans('Rate')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                           {{trans('1')}} {{ trans('USD') }} =
                                        </div>
                                    </div>

                                    <input type="text" class="form-control"
                                           name="rate"
                                           value="{{old('rate')}}"
                                    >
                                    <div class="input-group-append">
                                        <div class="input-group-text set-currency">

                                        </div>
                                    </div>
                                </div>
                                @error('rate')
                                <span class="text-danger">{{ trans($message)  }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-3 col-6">
                                <label>{{trans('Minimum Amount Send')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                           name="minimum_amount"
                                           value="{{old('minimum_amount')}}"
                                    >
                                    <div class="input-group-append">
                                        <div class="input-group-text set-currency">
                                        </div>
                                    </div>
                                </div>
                                @error('minimum_amount')
                                <span class="text-danger">{{ trans($message)  }}</span>
                                @enderror
                            </div>


                            <div class="col-md-3 col-6">
                                <div class="form-group ">
                                    <label>@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='status'>
                                        <input type="checkbox" name="status" class="custom-switch-checkbox" id="status"
                                               value="0">
                                        <label class="custom-switch-checkbox-label" for="status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="form-group ">
                                    <label>@lang('Send From')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='send_from'>
                                        <input type="checkbox" name="send_from" class="custom-switch-checkbox" id="send_from"
                                               value="0">
                                        <label class="custom-switch-checkbox-label" for="send_from">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="form-group ">
                                    <label>@lang('Send To')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='send_to'>
                                        <input type="checkbox" name="send_to" class="custom-switch-checkbox" id="send_to"
                                               value="0">
                                        <label class="custom-switch-checkbox-label" for="send_to">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-6 col-6">
                                <label>{{trans('Services')}}</label>
                                <select class="form-control form-control-lg  selectpicker service-change"
                                        data-live-search="true" name="facilities[]"
                                        required="" multiple="multiple">
                                    @foreach($services as $item)
                                        <option
                                            value="{{ $item->id }}" {{ old('facilities') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('facilities')
                                <span class="text-danger d-block mt-3">{{ trans($message)  }}</span>
                                @enderror
                            </div>


                        </div>






                        <div class="row justify-content-between">
                            <div class="col-sm-6 col-md-3">
                                <div class="image-input ">
                                    <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                    <input type="file" name="image" placeholder="@lang('Choose image')" id="image">
                                    <img id="image_preview_container" class="preview-image"
                                         src="{{ getFile(config('location.country.path'))}}"
                                         alt="preview image">
                                </div>
                                @error('image')
                                <span class="text-danger">{{ trans($message) }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">@lang('Details')</label>
                                    <textarea class="form-control  summernote @error('details') is-invalid @enderror"
                                              name="details">{{ old('details') }}</textarea>


                                    @error('details')
                                    <span class="text-danger">{{ trans($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn  btn-primary btn-block mt-3">@lang('Save Changes')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection




@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">

    <link href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
@endpush

@push('js')
    <script>
        "use strict";
        $(document).ready(function (e) {

            setCurrency();
            $(document).on('change', '.currency_code', function (){
                setCurrency();
            });

            function setCurrency() {
                let currency = $('.currency_code').val();
                $('.set-currency').text(currency);
            }

            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.currency-change').select2({
                selectOnClose: true
            });
            $('.service-change').select2({
                selectOnClose: true
            });


            $('.summernote').summernote({
                focus: true,
                callbacks: {
                    onBlurCodeview: function() {
                        let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                        $(this).val(codeviewHtml);
                    }
                }
            });

        });
    </script>
@endpush
