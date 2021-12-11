@extends($theme.'layouts.user')
@section('title',trans('2 Step Security'))

@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center">

                @if(auth()->user()->two_fa)
                    <div class="col-md-6 mb-3">
                        <div class=" search-log">
                            <div class="blog-content blog-content-card">
                                <div class="blog-content-main">
                                    <div class="blog-heading">
                                        <h3>@lang('Two Factor Authenticator')</h3>
                                    </div>
                                    <hr>
                                    <div class="paragraph">
                                        <div class="form-group">
                                            <div class="input-group  mx-xs-0 mx-md-3   px-1 px-sm-0 px-md-0">
                                                <input type="text" value="{{$previousCode}}"
                                                       class="form-control" id="referralURL"
                                                       readonly>

                                                <span class="input-group-text copytext bg-transparent" id="copyBoard"
                                                      onclick="copyFunction()">
                                                 <i class="fas fa-copy"></i>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="form-group mx-auto text-center">
                                            <img class="mx-auto" src="{{$previousQR}}">
                                        </div>
                                    </div>
                                    <div class="read-more-button">
                                        <a href="javascript:void(0)" class="btn btn-info btn-lg w-100"
                                           data-toggle="modal"
                                           data-target="#disableModal">@lang('Deactive Two Factor')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 mb-3">
                        <div class=" search-log">
                            <div class="blog-content blog-content-card">
                                <div class="blog-content-main">
                                    <div class="blog-heading">
                                        <h3>@lang('Two Factor Authenticator')</h3>
                                    </div>
                                    <hr>
                                    <div class="paragraph">
                                        <div class="form-group">
                                            <div class="input-group  mx-xs-0 mx-md-3   px-1 px-sm-0 px-md-0">
                                                <input type="text" value="{{$secret}}"
                                                       class="form-control" id="referralURL"
                                                       readonly>

                                                <span class="input-group-text copytext bg-transparent" id="copyBoard"
                                                      onclick="copyFunction()">
                                                 <i class="fas fa-copy"></i>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="form-group mx-auto text-center">
                                            <img class="mx-auto" src="{{$qrCodeUrl}}">
                                        </div>
                                    </div>
                                    <div class="read-more-button">
                                        <a href="javascript:void(0)" class="btn btn-info btn-lg w-100"
                                           data-toggle="modal"
                                           data-target="#enableModal">@lang('Active Two Factor')</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif


                <div class="col-md-6 mb-3">
                    <div class=" search-log">
                        <div class="blog-content blog-content-card">
                            <div class="blog-content-main">
                                <div class="blog-heading">
                                    <h3>@lang('Google Authenticator')</h3>
                                </div>
                                <hr>
                                <div class="paragraph">
                                    <h6 class="text-uppercase my-3 font-weight-bold">@lang('Use Google Authenticator to Scan the QR code  or use the code')</h6>
                                    <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')</p>

                                </div>
                                <div class="read-more-button">

                                    <a class="btn btn-info btn-lg px-3"
                                       href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                                       target="_blank">@lang('DOWNLOAD APP')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.twoStepEnable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control form-control-lg" name="code"
                                   placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-lg btn-success">@lang('Verify')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP to Disable')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.twoStepDisable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" name="code"
                                   placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-lg btn-success">@lang('Verify')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection



@push('script')
    <script>
        function copyFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>
@endpush

