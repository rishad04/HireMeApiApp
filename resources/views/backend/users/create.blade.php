{{-- Extends layout --}}
@extends('backend.partials.master')

@section('name')
    Create
@endsection

{{-- Content --}}
@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="trk-card">
                <div class="trk-card__wrapper">
                    {{-- Card Header Start --}}
                    <div class=" trk-table__header d-flex justify-content-between">
                        <div class="trk-table__name">
                            <h5>{{ $info->title }}</h5>
                        </div>
                        <div class="float-right">
                            <a href="{{ route($info->first_button_route) }}" class="btn btn-primary">

                                <i class="flaticon2-add"></i>

                                {{ $info->first_button_title }}
                            </a>
                        </div>
                    </div>
                    {{-- Card Header End --}}

                    {{-- Card Body Start --}}
                    <div class="trk-card__body">
                        <form class="form" action="{{ route($info->form_route) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-container">
                                <div class="form-row">
                                    <label for="name" class="form-label">Name:</label>
                                    <div class="form-input-wrapper">
                                        <input type="text" name="name" id="name" required class="form-input">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="email" class="form-label">Email:</label>
                                    <div class="form-input-wrapper">
                                        <input type="email" name="email" id="email" required class="form-input">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="password" class="form-label">Password:</label>
                                    <div class="form-input-wrapper">
                                        <input type="password" name="password" id="password" required class="form-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('button.create') }}</button>
                                    <button type="reset" class="btn btn-danger mt-4">{{ __('button.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Card Body End --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    @parent


@endsection

@section('js')
    @parent

@endsection
