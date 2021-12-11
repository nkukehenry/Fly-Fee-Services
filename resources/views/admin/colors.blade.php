@extends('admin.layouts.app')
@section('title')
    @lang('Color Settings')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">

            <form method="post" action="" novalidate="novalidate" class="needs-validation base-form">
                @csrf
                <div class="row">
                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('background_color'))}}</label>
                        <input type="color" name="background_color"
                               value="{{ old('background_color') ?? $control->background_color ??'' }}"
                               class="form-control ">
                        @error('background_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('background_alternative_color'))}}</label>
                        <input type="color" name="background_alternative_color"
                               value="{{ old('background_alternative_color') ?? $control->background_alternative_color ??'' }}"
                               class="form-control ">
                        @error('background_alternative_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('secondary_background_color'))}}</label>
                        <input type="color" name="secondary_background_color"
                               value="{{ old('secondary_background_color') ?? $control->secondary_background_color ??'' }}"
                               class="form-control ">
                        @error('secondary_background_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('base_color'))}}</label>
                        <input type="color" name="base_color"
                               value="{{ old('base_color') ?? $control->base_color ??'' }}"
                               class="form-control ">
                        @error('base_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('secondary_color'))}}</label>
                        <input type="color" name="secondary_color"
                               value="{{ old('secondary_color') ?? $control->secondary_color ??'' }}"
                               class="form-control ">
                        @error('secondary_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('secondary_alternative_color'))}}</label>
                        <input type="color" name="secondary_alternative_color"
                               value="{{ old('secondary_alternative_color') ?? $control->secondary_alternative_color ??'' }}"
                               class="form-control ">
                        @error('secondary_alternative_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('title_color'))}}</label>
                        <input type="color" name="title_color"
                               value="{{ old('title_color') ?? $control->title_color ??'' }}"
                               class="form-control ">
                        @error('title_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>



                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('text_color'))}}</label>
                        <input type="color" name="text_color"
                               value="{{ old('text_color') ?? $control->text_color ??'' }}"
                               class="form-control ">
                        @error('text_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>



                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('natural_color'))}}</label>
                        <input type="color" name="natural_color"
                               value="{{ old('natural_color') ?? $control->natural_color ??'' }}"
                               class="form-control ">
                        @error('natural_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('border_color'))}}</label>
                        <input type="color" name="border_color"
                               value="{{ old('border_color') ?? $control->border_color ??'' }}"
                               class="form-control ">
                        @error('border_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group  col-sm-6 col-md-4 col-lg-3">
                        <label class="text-dark">{{trans(snake2Title('error color'))}}</label>
                        <input type="color" name="error_color"
                               value="{{ old('error_color') ?? $control->error_color ??'' }}"
                               class="form-control ">
                        @error('error_color')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>





                </div>


                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span><i
                            class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
            </form>
        </div>
    </div>
@endsection
