{{-- Extends layout --}}
@extends('backend.partials.master')

@section('name')
    Create
@endsection

{{-- Content --}}
@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="my-card">
                <div class="my-card__wrapper">
                    {{-- Card Header Start --}}
                    <div class=" my-table__header d-flex justify-content-between">
                        <div class="my-table__name">
                            <h5>{{ $info->title }}</h5>
                        </div>
                    </div>
                    {{-- Card Header End --}}

                    {{-- Card Body Start --}}
                    <div class="my-card__body">
                        <form class="form" action="{{ route($info->form_route) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-container">
                                <div class="form-row">
                                    <label for="name" class="form-label">Name:</label>
                                    <div class="form-input-wrapper">
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            required
                                            class="form-input @error('name') input-error @enderror"
                                            value="{{ old('name') }}"
                                        >
                                        @error('name')
                                            <div class="error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label for="slug" class="form-label">Slug:</label>
                                    <div class="form-input-wrapper">
                                        <input
                                            type="text"
                                            name="slug"
                                            id="slug"
                                            required
                                            class="form-input @error('slug') input-error @enderror"
                                            value="{{ old('slug') }}"
                                        >
                                        @error('slug')
                                            <div class="error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('create') }}</button>
                                    <button type="reset" class="btn btn-danger mt-4">{{ __('reset') }}</button>
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
