@extends($theme.'layouts.user')
@section('title',trans('Profile Settings'))
@section('content')


    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container-fluid ">


            <div class="row justify-content-center mx-lg-5">
                <div class="col-md-4">
                    <div class="overview mx-lg-5 ">
                        <div class="overview-list search-log">
                            <form method="post" action="{{ route('user.updateProfile') }}"
                                  enctype="multipart/form-data">
                                <div class="input--group">
                                    @csrf
                                    <div class="image-input ">
                                        <label for="image-upload" id="image-label"><i
                                                class="fas fa-upload"></i></label>
                                        <input type="file" name="image" placeholder="@lang('Choose image')" id="image">
                                        <img id="image_preview_container" class="preview-image max-width-200 w-100"
                                             src="{{getFile(config('location.user.path').$user->image)}}"
                                             alt="preview image">
                                    </div>
                                    @error('image')
                                    <span class="text-danger">{{trans($message)}}</span>
                                    @enderror

                                </div>
                                <div class="input--group">
                                    <p>@lang('Joined At') @lang($user->created_at->format('d M, Y g:i A'))</p>
                                </div>
                                <div class="input--group text-center text-md-left">
                                    <button type="submit" class="btn btn-info btn-lg">
                                        <span>@lang('Image Update')</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 ">
                    <div class="overview mx-lg-5 mt-3 mt-md-0">
                        <div class="overview-list search-log">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link   {{ $errors->has('profile') ? 'show active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' : 'show active') }}"
                                       data-toggle="tab" data-target="#home" type="button" role="tab"
                                       aria-controls="home" aria-selected="true">@lang('Profile Information')</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $errors->has('password') ? 'active' : '' }}"
                                       data-toggle="tab" data-target="#password" type="button" role="tab"
                                       aria-controls="password" aria-selected="false">@lang('Password Setting')</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $errors->has('identity') ? 'active' : '' }}"
                                       data-toggle="tab" data-target="#identity" type="button" role="tab"
                                       aria-controls="identity" aria-selected="false">@lang('Identity Verification')</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $errors->has('addressVerification') ? 'active' : '' }}"
                                       data-toggle="tab" data-target="#addressVerification" type="button" role="tab"
                                       aria-controls="addressVerification"
                                       aria-selected="false">@lang('Address Verification')</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content " id="myTabContent">
                                <div id="home"
                                     role="tabpanel" aria-labelledby="home-tab"
                                     class="tab-pane fade px-3 pt-3 {{ $errors->has('profile') ? 'show active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' :  'show active') }}">
                                    <form action="{{ route('user.updateInformation')}}" method="post">
                                        @method('put')
                                        @csrf

                                        <div class="row ">

                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('First Name')</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                           name="firstname"
                                                           value="{{old('firstname')?? $user->firstname }}">
                                                    @if($errors->has('firstname'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('firstname')) </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('Last Name')</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                           name="lastname"
                                                           value="{{old('lastname')??$user->lastname }}">
                                                    @if($errors->has('lastname'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('lastname')) </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('Username')</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                           name="username"
                                                           value="{{old('username')?? $user->username }}">
                                                    @if($errors->has('username'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('username')) </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('Email Address')</label>
                                                    <input class="form-control form-control-lg" type="email"
                                                           value="{{ $user->email }}" readonly>
                                                    @if($errors->has('email'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('email')) </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('Phone Number')</label>
                                                    <input class="form-control form-control-lg" type="text" readonly
                                                           value="{{$user->phone}}">

                                                    @if($errors->has('phone'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('phone')) </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label>@lang('Preferred language')</label>
                                                    <select name="language_id" id="language_id"
                                                            class="form-control form-control-lg">
                                                        <option value="" disabled>@lang('Select Language')</option>
                                                        @foreach($languages as $la)
                                                            <option
                                                                value="{{$la->id}}" {{ old('language_id', $user->language_id) == $la->id ? 'selected' : '' }}>@lang($la->name)</option>
                                                        @endforeach
                                                    </select>

                                                    @if($errors->has('language_id'))
                                                        <span
                                                            class="error text-danger">@lang($errors->first('language_id')) </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label>@lang('Address')</label>
                                            <textarea class="form-control form-control-lg" name="address"
                                                      rows="5">{{old('address',$user->address)}}</textarea>
                                            @if($errors->has('address'))
                                                <span class="error text-danger">@lang($errors->first('address')) </span>
                                            @endif
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-info btn-lg w-100">
                                                @lang('Update User')</button>
                                        </div>
                                    </form>
                                </div>

                                <div id="password"
                                     role="tabpanel" aria-labelledby="password-tab"
                                     class="tab-pane fade px-3 pt-3 {{ $errors->has('password') ? 'show active' : '' }}   ">
                                    <form method="post" action="{{ route('user.updatePassword') }}">
                                        @csrf
                                        <div class="form-group mt-4">
                                            <label>@lang('Current Password')</label>

                                            <div class="input-group   mb-3">
                                                <input id="password" type="password"
                                                       class="form-control form-control-lg" aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="current_password" value="{{old('current_password')}}"
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

                                            @if($errors->has('current_password'))
                                                <span
                                                    class="error text-danger">@lang($errors->first('current_password')) </span>
                                            @endif
                                        </div>
                                        <div class="form-group mt-4">
                                            <label>@lang('New Password')</label>

                                            <div class="input-group   mb-3">
                                                <input id="password" type="password"
                                                       class="form-control form-control-lg" aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="password" value="{{old('password')}}" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                                        <a href="javascript:void(0)"
                                                           class="text-dark  clickShowPassword">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            @if($errors->has('password'))
                                                <span
                                                    class="error text-danger">@lang($errors->first('password')) </span>
                                            @endif
                                        </div>

                                        <div class="form-group ">
                                            <label>@lang('Confirm Password')</label>

                                            <div class="input-group   mb-3">
                                                <input id="password" type="password"
                                                       class="form-control form-control-lg" aria-label="Default"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       name="password_confirmation"
                                                       value="{{old('password_confirmation')}}" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                                        <a href="javascript:void(0)"
                                                           class="text-dark  clickShowPassword">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            @if($errors->has('password_confirmation'))
                                                <span
                                                    class="error text-danger">@lang($errors->first('password_confirmation')) </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <button type="submit"
                                                    class=" btn btn-info btn-lg w-100">@lang('Update Password')</button>
                                        </div>
                                    </form>
                                </div>

                                <div id="identity"
                                     role="tabpanel" aria-labelledby="identity-tab"
                                     class="tab-pane fade px-3 pt-3 {{ $errors->has('identity') ? 'show active' : '' }}   ">


                                    @if(in_array($user->identity_verify,[0,3])  )
                                        @if($user->identity_verify == 3)
                                            <div class="alert alert-danger" role="alert">
                                                @lang('You previous request has been rejected')
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.verificationSubmit')}}"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group mt-4">
                                                <label>@lang('Identity Type')</label>
                                                <select name="identity_type" id="identity_type"
                                                        class="form-control form-control-lg">
                                                    <option value="" selected disabled>@lang('Select Type')</option>
                                                    @foreach($identityFormList as $sForm)
                                                        <option
                                                            value="{{$sForm->slug}}" {{ old('identity_type', @$identity_type) == $sForm->slug ? 'selected' : '' }}>@lang($sForm->name)</option>
                                                    @endforeach
                                                </select>
                                                @error('identity_type')
                                                <span class="error text-danger">@lang($message) </span>
                                                @enderror
                                            </div>
                                            @if(isset($identityForm))
                                                @foreach($identityForm->services_form as $k => $v)
                                                    @if($v->type == "text")
                                                        <div class="form-group">
                                                            <label
                                                                for="{{$k}}">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span class="text-danger">*</span>  @endif </label>
                                                            <input type="text" name="{{$k}}"
                                                                   class="form-control form-control-lg"
                                                                   value="{{old($k)}}" id="{{$k}}"
                                                                   @if($v->validation == 'required') required @endif>
                                                            @error($k)
                                                            <div class="error-massage-alt text-danger">
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
                                                            <textarea name="{{$k}}" id="{{$k}}"
                                                                      class="form-control form-control-lg" rows="5"
                                                                      placeholder="{{trans('Type Here')}}"
                                                                      @if($v->validation == 'required') required @endif>{{old($k)}}</textarea>
                                                            @error($k)
                                                            <div class="error-massage-alt text-danger">
                                                                <span>{{trans($message)}}</span>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    @elseif($v->type == "file")
                                                        <div class="form-group">
                                                            <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span class="text-danger">*</span>  @endif </label>

                                                            <br>
                                                            <div class="fileinput fileinput-new "
                                                                 data-provides="fileinput">
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
                                                                        <input type="file" name="{{$k}}"
                                                                               value="{{ old($k) }}" accept="image/*"
                                                                               @if($v->validation == "required") required @endif>
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                                       data-dismiss="fileinput"> @lang('Remove')</a>
                                                                </div>

                                                            </div>

                                                            @error($k)
                                                            <div class="error-massage-alt text-danger">
                                                                <span>{{trans($message)}}</span>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    @endif

                                                @endforeach

                                                <div class="form-group">
                                                    <button type="submit"
                                                            class=" btn btn-info btn-lg w-100">@lang('Submit')</button>
                                                </div>
                                            @endif
                                        </form>
                                    @elseif($user->identity_verify == 1)
                                            <div class="alert alert-warning" role="alert">
                                                @lang('Your KYC submission has been pending')
                                            </div>
                                    @elseif($user->identity_verify == 2)
                                            <div class="alert alert-success" role="alert">
                                                @lang('Your KYC already verified')
                                            </div>
                                    @endif
                                </div>

                                <div id="addressVerification"
                                     role="tabpanel" aria-labelledby="addressVerification-tab"
                                     class="tab-pane fade px-3 pt-3 {{ $errors->has('addressVerification') ? 'show active' : '' }}   ">
                                    @if(in_array($user->address_verify,[0,3])  )
                                        @if($user->address_verify == 3)
                                            <div class="alert alert-danger" role="alert">
                                                @lang('You previous request has been rejected')
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.addressVerification')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label>{{trans('Address Proof')}} <span class="text-danger">*</span>  </label>

                                                    <br>
                                                    <div class="fileinput fileinput-new "
                                                         data-provides="fileinput">
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
                                                                            class="fileinput-new "> @lang('Select Image') </span>
                                                                        <span
                                                                            class="fileinput-exists"> @lang('Change')</span>
                                                                        <input type="file" name="addressProof"
                                                                               value="{{ old('addressProof')}}" accept="image/*">
                                                                    </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                               data-dismiss="fileinput"> @lang('Remove')</a>
                                                        </div>

                                                    </div>

                                                    @error('addressProof')
                                                    <div class="error-massage-alt text-danger">
                                                        <span>{{trans($message)}}</span>
                                                    </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <button type="submit"
                                                            class=" btn btn-info btn-lg w-100">@lang('Submit')</button>
                                                </div>

                                        </form>
                                    @elseif($user->address_verify == 1)
                                        <div class="alert alert-warning" role="alert">
                                            @lang('Your KYC submission has been pending')
                                        </div>
                                    @elseif($user->address_verify == 2)
                                        <div class="alert alert-success" role="alert">
                                            @lang('Your KYC already verified')
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection

@push('css-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('extra-js')
    <script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush


@push('script')
    <script>
        "use strict";
        $(document).on('click', '#image-label', function () {
            $('#image').trigger('click');
        });
        $(document).on('change', '#image', function () {
            var _this = $(this);
            var newimage = new FileReader();
            newimage.readAsDataURL(this.files[0]);
            newimage.onload = function (e) {
                $('#image_preview_container').attr('src', e.target.result);
            }
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


        $(document).ready(function () {
            $("#identity_type").selectmenu({
                change: function (event, ui) {
                    window.location.href = "{{route('user.profile')}}/?identity_type=" + $(ui.item.element).val()
                }
            });
        });
    </script>


@endpush
