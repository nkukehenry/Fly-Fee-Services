@extends('admin.layouts.app')
@section('title',trans($page_title))


@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">


            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('SL')</th>
                        <th scope="col">@lang('User')</th>
                        <th scope="col">@lang('Coupon Code')</th>
                        <th scope="col">@lang('Reduce Fee (%)')</th>
                        <th scope="col">@lang('Used At')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($coupons as $data)
                        <tr>
                            <td data-label="@lang('SL')">{{loopIndex($coupons) + $loop->index	 }}</td>
                            <td data-label="@lang('User')" class="font-weight-bold">
                                <a href="{{route('admin.user-edit',[$data->user_id])}}">
                                    {{optional($data->user)->username}}
                                </a>
                            </td>
                            <td data-label="@lang('Coupon Code')">@lang($data->code)</td>
                            <td data-label="@lang('Reduce Fee (%)')">{{getAmount($data->reduce_fee)}}{{trans('%')}}</td>

                            <td data-label="@lang('Used At')">{{dateTime($data->used_at)}}</td>

                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="3">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$coupons->links('partials.pagination')}}

            </div>
        </div>
    </div>



@endsection
