@extends($theme.'layouts.user')
@section('title',trans($page_title))

@section('content')

    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class=" overview mb-5">
                        <div class="overview-list search-log">
                            <div class="  justify-content-between align-items-center d-flex my-3">
                                <h5 class="card-title ">@lang($page_title)</h5>
                                <a href="{{route('user.ticket.create')}}" class="btn btn-sm btn-success"> <i
                                        class="fa fa-plus-circle"></i> @lang('Create Ticket')</a>
                            </div>


                            <div class="table-responsive">
                                <table class="table  table-striped table-bordered text-center" id="service-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Subject')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Last Reply')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tickets as $key => $ticket)
                                        <tr>
                                            <td data-label="@lang('Sl')">{{loopIndex($tickets) + $loop->index}}</td>
                                            <td data-label="@lang('Subject')">
                                                    <span
                                                        class="font-weight-bold"> [{{ trans('Ticket#').$ticket->ticket }}
                                                        ] {{ $ticket->subject }} </span>
                                            </td>
                                            <td data-label="@lang('Status')">
                                                @if($ticket->status == 0)
                                                    <span class="badge badge-success">@lang('Open')</span>
                                                @elseif($ticket->status == 1)
                                                    <span class="badge badge-primary">@lang('Answered')</span>
                                                @elseif($ticket->status == 2)
                                                    <span class="badge badge-warning">@lang('Replied')</span>
                                                @elseif($ticket->status == 3)
                                                    <span class="badge badge-dark">@lang('Closed')</span>
                                                @endif
                                            </td>

                                            <td data-label="@lang('Last Reply')">
                                                {{diffForHumans($ticket->last_reply) }}
                                            </td>

                                            <td data-label="@lang('Action')">
                                                <a href="{{ route('user.ticket.view', $ticket->ticket) }}"  class="btn btn-info"
                                                   title="{{trans('Details')}}"><i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center mb-4">
                                            <td colspan="100%">{{trans('No Data Found!')}}</td>
                                        </tr>

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $tickets->appends($_GET)->links($theme.'partials.pagination') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
