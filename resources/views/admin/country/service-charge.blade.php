@extends('admin.layouts.app')
@section('title', trans($page_title))


@section('content')




    <div class="row">
        <div class="col-md-6">

            <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
                <div class="card-body">



                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('SL')</th>
                                <th scope="col">@lang('Up to Amount')</th>
                                <th scope="col">@lang('Charge')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($countryServiceCharge as $key => $data)
                            <tr>
                                <td data-label="@lang('SL')">{{trans('LEVEL')}} #{{++$key}}</td>
                                <td data-label="@lang('Up to Amount')">
                                    <h5 class="text-dark mb-0 font-16 ">{{$data->amount}} {{$country->code}}</h5>
                                </td>
                                <td data-label="@lang('Charge')">
                                    {{$data->charge}} {{($data->type == 2) ? '%':$country->code}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center text-danger" colspan="3">@lang('No Data Found')</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
                <div class="card-body">

                    <div class="row  formFiled justify-content-center ">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('Set Level')</label>
                                <input type="number" name="level" placeholder="@lang('Number Of Level')"
                                       class="form-control  numberOfLevel">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-block  makeForm ">
                                    <i class="fa fa-spinner"></i> @lang('GENERATE')
                                </button>
                            </div>
                        </div>


                    </div>

                    <form action="{{route('admin.country.service.charge.store')}}" method="post" class="form-row">
                        @csrf

                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <div class="col-md-12 newFormContainer">

                        </div>


                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-primary btn-block mt-3 submit-btn">@lang('Submit')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection


@push('js')
    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif

    <script>
        "use strict";
        $(document).ready(function () {

            $('.submit-btn').addClass('d-none');

            $(".makeForm").on('click', function () {

                var levelGenerate = $(this).parents('.formFiled').find('.numberOfLevel').val();
                var value = 1;
                var viewHtml = '';
                if (levelGenerate !== '' && levelGenerate > 0) {
                    for (var i = 0; i < parseInt(levelGenerate); i++) {
                        viewHtml += `<div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-right-border">LEVEL #${value++}</span>
                            </div>
                            <select name="type[]" class="form-control">
                                <option value="1">@lang('Fixed Charge')</option>
                                <option value="2">@lang('Percent Charge')</option>
                            </select>
                            <input name="amount[]" class="form-control" type="number"  value="" required placeholder="@lang('Amount')">
                            <input name="charge[]" class="form-control" type="number" required placeholder="@lang("Charge")" >
                            <span class="input-group-btn">
                            <button class="btn btn-danger removeForm" type="button"><i class='fa fa-trash-alt'></i></button></span>
                            </div>`;
                    }

                    $('.newFormContainer').html(viewHtml);
                    $('.submit-btn').addClass('d-block');
                    $('.submit-btn').removeClass('d-none');

                } else {

                    $('.submit-btn').addClass('d-none');
                    $('.submit-btn').removeClass('d-block');
                    $('.newFormContainer').html(``);
                    Notiflix.Notify.Failure("{{trans('Please Set number of level')}}");
                }
            });

            $(document).on('click', '.removeForm', function () {
                $(this).closest('.input-group').remove();
            });


            $('select').select2({
                selectOnClose: true
            });

        });


    </script>
@endpush
