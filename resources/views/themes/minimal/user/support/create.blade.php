@extends($theme.'layouts.user')
@section('title',trans($page_title))

@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class=" overview mb-5">
                        <div class="support-create overview-list search-log">
                            <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group ">
                                    <label>@lang('Subject')</label>
                                    <input class="form-control form-control-lg" type="text" name="subject"
                                           value="{{old('subject')}}" placeholder="@lang('Enter Subject')">
                                    @error('subject')
                                    <span class="error text-danger">@lang($message) </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>@lang('Message')</label>
                                    <textarea class="form-control form-control-lg ticket-box" name="message" rows="5"
                                              id="textarea1"
                                              placeholder="@lang('Enter Message')">{{old('message')}}</textarea>
                                    @error('message')
                                    <span class="error text-danger">@lang($message) </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input type="file" name="attachments[]"
                                           class="form-control form-control-lg"
                                           multiple
                                           placeholder="@lang('Upload File')">

                                    @error('attachments')
                                    <span class="text-danger">{{trans($message)}}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-info btn-lg w-100">@lang('Submit')</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
