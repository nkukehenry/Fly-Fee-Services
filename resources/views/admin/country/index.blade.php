@extends('admin.layouts.app')
@section('title')
    @lang("Country List")
@endsection


@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-2 text-right">
                @if(adminAccessRoute(config('role.remit_operation.access.add')))
                <a href="{{route('admin.country.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> {{trans('Add New')}} </a>
                @endif

                @if(adminAccessRoute(config('role.remit_operation.access.edit')))
                <div class="dropdown ">
                    <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active">@lang('Active')</button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive">@lang('Inactive')</button>
                    </div>
                </div>
                @endif
            </div>


            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        @if(adminAccessRoute(config('role.remit_operation.access.edit')))
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>
                        @endif
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Country')</th>
                        <th scope="col">@lang('Continent')</th>
                        <th scope="col">@lang('Facilities')</th>
                        <th scope="col">@lang('Rate')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($countries as $data)
                        <tr>
                            @if(adminAccessRoute(config('role.remit_operation.access.edit')))
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{ $data->id }}"
                                       class="form-check-input row-tic tic-check" name="check" value="{{$data->id}}"
                                       data-id="{{ $data->id }}">
                                <label for="chk-{{ $data->id }}"></label>
                            </td>
                            @endif
                            <td data-label="@lang('No.')">{{loopIndex($countries) + $loop->index	 }}</td>
                            <td data-label="@lang('Country')">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3"><img src="{{ getFile(config('location.country.path').$data->image)}}" alt="user" class="rounded-circle" width="25" height="25"></div>
                                    <div>
                                        <h5 class="text-dark mb-0 font-16 ">@lang($data->name)</h5>
                                    </div>
                                </div>
                            </td>
                            <td data-label="@lang('Continent')"><h5 class="font-weight-medium">@lang(optional($data->continent)->name)</h5></td>
                            <td data-label="@lang('Facilities')">
                                @if($data->facilities)
                                @foreach($data->facilities as $key => $item)
                                        <span
                                            class="badge badge-pill badge-primary">{{ trans($item->name)}}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td data-label="@lang('Rate')">{{trans('1')}} {{trans('USD')}} = <b>{{getAmount($data->rate, config('basic.fraction_number'))}}  {{$data->code}}</b></td>
                            <td data-label="@lang('Status')">
                                <span
                                    class="badge badge-pill {{ $data->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $data->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>
                            <td data-label="@lang('Action')">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if(adminAccessRoute(config('role.remit_operation.access.edit')))
                                        <a class="dropdown-item" href="{{ route('admin.country.edit',$data) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')
                                        </a>
                                        @endif

                                        @if(adminAccessRoute(config('role.remit_operation.access.view')))
                                        <a class="dropdown-item" href="{{ route('admin.country.service',$data) }}">
                                            <i class="fa fa-life-ring text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Service')
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$countries->links('partials.pagination')}}

            </div>
        </div>
    </div>




    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Active Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p>@lang("Are you really want to active the country's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('DeActive Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p>@lang("Are you really want to Inactive the country's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary inactive-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')
    <script>
        "use strict";

        $(document).on('click', '#check-all', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('change', ".row-tic", function () {
            let length = $(".row-tic").length;
            let checkedLength = $(".row-tic:checked").length;
            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        //dropdown menu is not working
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //multiple active
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{ route('admin.country.multiple-active') }}",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                },
            });
        });

        //multiple deactive
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{ route('admin.country.multiple-inactive') }}",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                }
            });
        });


        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });

    </script>
@endpush
