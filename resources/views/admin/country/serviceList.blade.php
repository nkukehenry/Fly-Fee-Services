@extends('admin.layouts.app')
@section('title', trans($page_title))



@section('content')

    <div id="crudApp">

        <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
            <div class="card-body">
                <button data-toggle="modal" data-target="#btn_add" type="button"
                        class="btn btn-primary mb-3 float-right">
                    <i  class="fa fa-plus" ></i> {{trans('Add New')}}
                </button>


                <div class="table-responsive">
                    <table class="categories-show-table table table-hover table-striped table-bordered" >
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">@lang('SL')</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item , index ) in items">
                            <td data-label="@lang('SL')">@{{++index}}</td>
                            <td data-label="@lang('Name')">@{{item.name}}</td>
                            <td data-label="@lang('Status')">

                                <span v-if="item.status == 1" class="badge badge-success badge-pill">{{trans('Active')}}</span>
                                <span v-else class="badge badge-danger badge-pill">{{trans('Deactive')}}</span>
                            </td>

                            <td data-label="@lang('Action')">
                                <a href="javascript:void(0)"
                                   data-toggle="modal" data-target="#editModal" @click="setVal(item)"
                                   class="btn btn-primary btn-sm"
                                   data-original-title="@lang('Edit')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)"
                                   data-toggle="modal" data-target="#DelModal" @click="setVal(item)"
                                   class="btn btn-danger btn-sm d-none"
                                   data-original-title="@lang('Remove')">
                                    <i class="fa fa-trash-alt"></i>
                                </a>

                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


        <div class="modal fade" id="btn_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> {{trans('Add New')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <ul class="list-style-none" v-if="hasErrors">
                        <li v-for="value in hasErrors"  class="text-danger" v-html="value[0]"></li>
                        </ul>

                        <div class="form-group">
                            <label for="inputName" class="control-label"><strong>{{trans('Continent Name')}} :</strong>
                            </label>
                                <input type="text" class="form-control form-control-lg "
                                       v-model="newItem.name"
                                       placeholder="{{trans('Enter a continent')}}" value="">

                        </div>

                        <div class="form-group">
                            <label for="inputName" class="control-label"><strong>{{trans('Status')}} :</strong>
                            </label>
                            <select v-model="newItem.status" class="form-control form-control-lg">
                                <option value="">{{trans('Select Status')}}</option>
                                <option value="1">{{trans('Active')}}</option>
                                <option value="0">{{trans('Deactive')}}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            {{trans('Close')}}
                        </button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createItem"
                                id="btn-save" value="add"> {{trans('Save')}}
                        </button>
                    </div>

                </div>
            </div>

        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-alt"></i> {{trans('Edit Form')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <ul class="list-style-none" v-if="hasErrors">
                            <li v-for="value in hasErrors"  class="text-danger" v-html="value[0]"></li>
                        </ul>

                        <div class="form-group ">
                            <label for="inputName" class="control-label"><strong>{{trans('Continent Name')}} :</strong> </label>
                            <input type="text" class="form-control form-control-lg" v-model="oldItem.name"
                                       placeholder="{{trans('Enter a continent')}}" value="">
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="control-label"><strong>{{trans('Status')}} :</strong>
                            </label>
                            <select v-model="oldItem.status" class="form-control form-control-lg">
                                <option value="">{{trans('Select Status')}}</option>
                                <option value="1">{{trans('Active')}}</option>
                                <option value="0">{{trans('Deactive')}}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            {{trans('Close')}}
                        </button>

                        <button type="submit" @click.prevent="updateItem" class="btn btn-primary"><i
                                class="fa fa-send"></i> {{trans('Update')}}
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal for DELETE -->
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class='fa fa-trash-alt'></i> {{trans('Delete Confirmation!')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <strong>@lang('Are you sure want to delete?')</strong>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            {{trans('Close')}}
                        </button>
                        <button type="submit" @click.prevent="deleteItem(oldItem.id)" class="btn btn-primary ">{{trans('Delete')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


@push('js')

    <script src="{{asset('assets/admin/js/vue.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/axios.min.js')}}"></script>
    <script>

        "use strict";
        var app = new Vue({
            el: "#crudApp",
            data: {
                items: [],
                pagination: [],
                newItem: {
                    'name': '',
                    'status': ''
                },
                oldItem: {
                    'name': '',
                    'status': ''
                },
                hasErrors: [],
                alert: null,
            },

            mounted() {
                this.getItems();
            },
            methods: {
                getItems() {
                    axios.get("{{route('admin.list.service')}}")
                        .then(response => {
                            this.items = response.data;
                        });
                },
                createItem() {

                    var _this = this;
                    axios.post("{{route('admin.store.service')}}", this.newItem)
                        .then(response => {
                            var data = response.data;

                            if (data.status === 'success') {
                                this.items.push(data.data);
                                Notiflix.Notify.Success("" + data.message);
                                this.reset();
                            } else {
                                Notiflix.Notify.Failure("" + data.message);
                            }


                            $('#btn_add').modal('hide');
                        })
                        .catch(err => {
                            var getError = err.response.data.errors;
                            this.hasErrors = getError;
                        });
                },
                reset() {
                    this.newItem = {
                        'name': '',
                        'status': ''
                    },
                        this.oldItem = {
                            'name': '',
                            'status': ''
                        }
                },
                setVal(items) {
                    this.oldItem.id = items.id;
                    this.oldItem.name = items.name;
                    this.oldItem.status = items.status;
                },
                updateItem() {
                    var _this = this;

                    axios.post("{{route('admin.update.service')}}", this.oldItem)
                        .then(response => {
                            var data = response.data;
                            if (data.status === 'success') {
                                $('#editModal').modal('hide');
                                Notiflix.Notify.Success("" + data.message);
                                _this.getItems();
                                _this.reset();
                            } else {
                                $('#editModal').modal('hide')
                                Notiflix.Notify.Failure("" + data.message);
                            }
                        })
                        .catch(err => {
                            if (err.response != undefined) {
                                var getError = err.response.data.errors;
                                this.hasErrors = getError;
                            }
                        });
                },
                deleteItem(id) {
                    var _this = this;
                    var social = {
                        'id': id
                    };
                    axios.post("{{route('admin.delete.service')}}", social)
                        .then(res => {
                            var data = res.data;
                            if (data.status === 'success') {
                                $("#DelModal").modal('hide');
                                Notiflix.Notify.Success("" + data.message);
                                this.getItems();
                            } else {
                                $('#DelModal').modal('hide')
                                Notiflix.Notify.Failure("" + data.message);
                            }
                        })
                        .catch(err => {
                            if (err.response != undefined) {
                                var getError = err.response.data.errors;
                                this.hasErrors = getError;
                            }
                        });
                }
            }

        });
    </script>

@endpush
