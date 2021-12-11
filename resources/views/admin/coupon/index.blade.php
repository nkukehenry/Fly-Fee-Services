@extends('admin.layouts.app')
@section('title',trans($page_title))


@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            @if(adminAccessRoute(config('role.manage_coupon.access.add')))
            <div class="text-right mb-2">
                <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#all_active">@lang('Coupon Generate')</button>
            </div>
            @endif



            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('SL')</th>
                        <th scope="col">@lang('Coupon Code')</th>
                        <th scope="col">@lang('Reduce Fee (%)')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($coupons as $data)
                        <tr>
                            <td data-label="@lang('SL')">{{loopIndex($coupons) + $loop->index	 }}</td>
                            <td data-label="@lang('Coupon Code')" class="font-weight-bold">@lang($data->code)</td>
                            <td data-label="@lang('Reduce Fee (%)')" class="font-weight-bold">{{getAmount($data->reduce_fee)}}{{trans('%')}}</td>
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




    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.coupon.store')}}" method="post">
                    @csrf
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title">@lang('Coupon Generate')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{trans('HOW MANY COUPON CODE')}}</label>
                            <input type="number" name="level" class="form-control form-control-lg" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('Reduce fee(%)')}}</label>
                            <input type="number" name="reduce_fee" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit"  class="btn btn-primary">@lang('Save')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection


@push('js')
    @if ($errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
            Notiflix.Notify.Failure("{{ $error }}");
            @endforeach
        </script>
    @endif
@endpush
