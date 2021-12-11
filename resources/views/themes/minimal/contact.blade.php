@extends($theme.'layouts.app')
@section('title',trans($title))
@section('content')
    <section id="contact-us" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="500">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pr-lg-0">
                    <div class="contact-form">
                        <div class="content-title">
                            <h5>@lang(@$contact->title)</h5>
                        </div>
                        <div class="paragraph">
                            <p>@lang(@$contact->short_details)</p>
                        </div>

                        <form action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name">{{trans('Your Name')}}</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}"
                                               placeholder="{{trans('Enter Your Name')}}">
                                        @error('name')
                                        <span class="text-danger mt-2">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="email">{{trans('Email')}}</label>
                                        <input type="email" name="email" value="{{old('email')}}" id="email"
                                               placeholder="{{trans('Enter Email Address')}}">
                                        @error('email')
                                        <span class="text-danger mt-2">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="subject">{{trans('Your Subject')}}</label>
                                        <input type="text" id="subject" name="subject" value="{{old('subject')}}"
                                               placeholder="{{trans('Enter Your Subject')}}">
                                        @error('subject')
                                        <span class="text-danger mt-2">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="massage">@lang('Message')</label>
                                        <textarea id="massage"
                                                  placeholder="{{trans('Type your message')}}">{{old('message')}} </textarea>
                                        @error('message')
                                        <span class="text-danger mt-2">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="send-massage-button">
                                <button class="anim-button" type="submit">
                                    <span class="layer1">{{trans('Send Message')}}</span>
                                    <span class="layer2"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5 pl-lg-0">
                    <div class="contact-info">
                        <div class="overlayer"></div>
                        <div class="contact-card-wrapper">
                            <div class="contact-card">
                                <div class="icon">
                                    <img src="{{asset($themeTrue.'images/address/1.png')}}" alt="icon">
                                </div>
                                <div class="content-title">
                                    <h4>{{trans('Office Address')}}</h4>
                                </div>
                                <div class="paragraph">
                                    <p>@lang(@$contact->address)</p>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="contact-card">

                                <div class="icon">
                                    <img src="{{asset($themeTrue.'images/address/2.png')}}" alt="icon">
                                </div>
                                <div class="content-title">
                                    <h4>{{trans('Email Address')}}</h4>
                                </div>
                                <div class="paragraph">
                                    <p>@lang(@$contact->email)</p>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="contact-card">
                                <div class="icon">
                                    <img src="{{asset($themeTrue.'images/address/3.png')}}" alt="icon">
                                </div>
                                <div class="content-title">
                                    <h4>{{trans('Phone Number')}}</h4>
                                </div>
                                <div class="paragraph">
                                    <p>@lang(@$contact->phone)</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include($theme.'sections.we-accept')

@endsection
