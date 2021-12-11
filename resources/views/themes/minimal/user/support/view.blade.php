@extends($theme.'layouts.user')
@section('title',trans($page_title))
@push('style')
@endpush
@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class=" overview mb-5">
                        <div class="overview-list search-log">

                            <div class="row justify-content-between align-items-center d-flex flex-wrap my-3">
                                <div class="col-sm-10 col-10">
                                   <h5> @if($ticket->status == 0)
                                           <span class="badge badge-primary">@lang('Open')</span>
                                       @elseif($ticket->status == 1)
                                           <span class="badge badge-success">@lang('Answered')</span>
                                       @elseif($ticket->status == 2)
                                           <span class="badge badge-dark">@lang('Customer Reply')</span>
                                       @elseif($ticket->status == 3)
                                           <span class="badge badge-danger">@lang('Closed')</span>
                                       @endif
                                       [{{trans('Ticket#'). $ticket->ticket }}] {{ $ticket->subject }}</h5>
                                </div>
                                <div class="col-sm-2 col-2">
                                    <div class="text-sm-right mt-sm-0 mt-3">
                                        <button type="button" class="btn btn-sm btn-danger float-right"
                                                title="{{trans('Close')}}"
                                                data-toggle="modal"
                                                data-target="#closeTicketModal"><i
                                                class="fa fa-times-circle"></i></button>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                            <form class="form-row d-flex flex-wrap justify-content-between align-items-center" action="{{ route('user.ticket.reply', $ticket->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-sm-12 col-md-9 col-12">
                                    <div class="form-group mt-0 mb-0">
                                                <textarea name="message" class="form-control  ticket-box w-100"
                                                          id="textarea1"
                                                          placeholder="@lang('Type Here')"
                                                          rows="3">{{old('message')}}</textarea>
                                    </div>
                                    @error('message')
                                    <span class="text-danger">{{trans($message)}}</span>
                                    @enderror
                                </div>


                                <div class=" col-sm-12 col-md-3 col-12">
                                    <div class="form-group">
                                        <div class="card-body-buttons mt-2 gap-3 mx-auto">

                                            <div class="upload-btn ">
                                                <div class="btn btn-primary new-file-upload "
                                                     title="{{trans('Image Upload')}}">
                                                    <a href="#">
                                                        <i class="fa fa-image fa-2x"></i>
                                                    </a>
                                                    <input type="file" name="attachments[]" id="upload"
                                                           class="upload-box"
                                                           multiple
                                                           placeholder="@lang('Upload File')">
                                                </div>
                                                <p class="text-danger select-files-count"></p>
                                            </div>

                                            <div class="submit-btn ml-2">
                                                <button type="submit" name="replayTicket" value="1"
                                                        class="cmn-btn btn-sm " title="{{trans('Reply')}}"><i class="fab fa-telegram-plane fa-2x"></i></button>
                                            </div>
                                        </div>
                                        @error('attachments')
                                        <span class="text-danger">{{trans($message)}}</span>
                                        @enderror

                                    </div>
                                </div>
                            </form>


                            @if(count($ticket->messages) > 0)
                                <div class="chat-box scrollable position-relative scroll-height">
                                    <ul class="chat-list  ">
                                        @foreach($ticket->messages as $item)
                                            @if($item->admin_id == null)
                                                <li class="chat-item list-style-none replied text-right user-complain mt-2">
                                                    <div class="chat-img d-inline-block">
                                                        <img
                                                            src="{{getFile(config('location.user.path').optional($ticket->user)->image)}}"
                                                            alt="user"
                                                            class="rounded-circle" width="45">
                                                    </div>
                                                    <div class="w-100 text-right">
                                                        <div class="chat-content d-inline-block pr-3">
                                                            <h6 class="font-weight-bold">{{optional($ticket->user)->username}} </h6>

                                                            <div class="d-flex flex-row-reverse">
                                                                <div class="msg p-2 d-inline-block mb-1">
                                                                    {{$item->message}}
                                                                </div>

                                                            </div>

                                                            @if(0 < count($item->attachments))
                                                                <div class="d-flex justify-content-end gap-2 ">
                                                                    @foreach($item->attachments as $k=> $image)
                                                                        <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                                           class="ml-3 nowrap "><i
                                                                                class="fa fa-file"></i> @lang('File') {{++$k}}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <div
                                                                class="chat-time">{{dateTime($item->created_at, 'd M, y h:i A')}}
                                                            </div>

                                                        </div>

                                                    </div>

                                                </li>


                                            @else

                                                <li class="chat-item list-style-none admin-feedback mt-2">
                                                    <div class="chat-img d-flex ">
                                                        <div class="chat-img d-inline-block ">
                                                            <img
                                                                src="{{getFile(config('location.admin.path').optional($item->admin)->image)}}"
                                                                alt="user"
                                                                class="rounded-circle" width="45">
                                                        </div>
                                                        <div class="chat-content d-inline-block pl-3">
                                                            <h6 class="font-weight-bold">{{optional($item->admin)->name}}</h6>

                                                            <div class="media">
                                                                <div class="msg p-2 d-inline-block mb-1">
                                                                    {{$item->message}}
                                                                </div>

                                                            </div>


                                                            @if(0 < count($item->attachments))
                                                                <div class="d-flex justify-content-start">
                                                                    @foreach($item->attachments as $k=> $image)
                                                                        <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                                           class="mr-3 nowrap"><i
                                                                                class="fa fa-file"></i> @lang('File') {{++$k}}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif


                                                            <div
                                                                class="chat-time d-block font-10 mt-0 mr-0 mb-3">{{dateTime($item->created_at, 'd M, y h:i A')}}</div>
                                                        </div>

                                                    </div>

                                                </li>


                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            @endif

                        </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <div class="modal fade" id="closeTicketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">

                <form method="post" action="{{ route('user.ticket.reply', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Confirmation')</h5>
                        <button type="button" class="close close-button" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h5>@lang('Are you want to close ticket?')</h5>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-dark " data-dismiss="modal">
                            @lang('Close')
                        </button>

                        <button type="submit" class="btn btn-success " name="replayTicket"
                                value="2">@lang("Confirm")
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict';
        $(document).on('change', '#upload', function () {
            var fileCount = $(this)[0].files.length;
            $('.select-files-count ').text(fileCount + ' file(s) selected')
        })
    </script>
@endpush


