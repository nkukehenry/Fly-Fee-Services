@extends('admin.layouts.app')

@section('title')
    @lang('profile')
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5"><i class="icon-key"></i> @lang('Password Setting')</h4>
                        <form action="" method="post" class="form-body file-upload">
                            @csrf
                            @method('put')


                            <div class="form-body">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">@lang('Current Password')</label>
                                        <div class="col-lg-6">

                                            <div class="input-group mb-3">
                                                <input id="password" type="password"
                                                       class="form-control " aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="current_password" value="{{old('current_password')}}" placeholder="@lang('Current Password')"
                                                       autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                                        <a href="javascript:void(0)"
                                                           class="text-dark clickShowPassword">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            @error('current_password')
                                            <span class="text-danger">{{ trans($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">@lang('New Password')</label>
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <input id="password" type="password"
                                                       class="form-control " aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="password" value="{{old('password')}}" placeholder="@lang('New Password')"
                                                       autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                                        <a href="javascript:void(0)"
                                                           class="text-dark clickShowPassword">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            @error('password')
                                            <span class="text-danger">{{ trans($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">@lang('Confirm Password')</label>
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <input id="password" type="password"
                                                       class="form-control " aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="@lang('Confirm Password')"
                                                       autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                                        <a href="javascript:void(0)"
                                                           class="text-dark clickShowPassword">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <div class="row ">
                                        <div class="col-md-6 offset-md-2">
                                                <button type="submit" class="btn btn-rounded btn-primary btn-block mt-3">@lang('Change Password')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection

@push('js-lib')
@endpush

@push('js')
    <script>
        $(document).ready(function (e) {
            "use strict";

            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        $(document).on('click', '.clickShowPassword', function () {
            var passInput = $(this).closest('.input-group').find('input');
            if (passInput.attr('type') === 'password') {
                $(this).children().addClass('fa-eye');
                $(this).children().removeClass('fa-eye-slash');
                passInput.attr('type', 'text');
            } else {
                $(this).children().addClass('fa-eye-slash');
                $(this).children().removeClass('fa-eye');
                passInput.attr('type', 'password');
            }
        })
    </script>
@endpush
