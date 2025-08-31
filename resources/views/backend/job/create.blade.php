{{-- Extends layout --}}
@extends('backend.partials.master')

@section('name')
Create
@endsection

{{-- Content --}}
@section('container')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y mb-4">
        <div class="card ">
             <div class="card-body">

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
                                                <label for="title" class="form-label">Title:</label>
                                                <div class="form-input-wrapper">
                                                    <input
                                                        type="text"
                                                        name="title"
                                                        id="title"
                                                        required
                                                        class="form-input @error('title') input-error @enderror"
                                                        value="{{ old('title') }}">
                                                    @error('title')
                                                    <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="form-row">
                                                <label for="slug" class="form-label">Slug:</label>
                                                <div class="form-input-wrapper">
                                                    <input
                                                        type="text"
                                                        name="slug"
                                                        id="slug"
                                                        required
                                                        class="form-input @error('slug') input-error @enderror"
                                                        value="{{ old('slug') }}">
                                                    @error('slug')
                                                    <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                           <div class="form-row">
                                                <label for="type" class="form-label">Type:</label>
                                                <div class="form-input-wrapper">
                                                    <select name="type" id="type" class="form-input @error('type') input-error @enderror" required>
                                                        <option value="">-- Select Type --</option>
                                                        <option value="full_time" {{ old('type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                                        <option value="part_time" {{ old('type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                                        <option value="contractual" {{ old('type') == 'contractual' ? 'selected' : '' }}>Contractual</option>
                                                    </select>

                                                    @error('type')
                                                        <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <label for="localtion" class="form-label">Location:</label>
                                                <div class="form-input-wrapper">
                                                    <input
                                                        type="text"
                                                        name="location"
                                                        id="location"
                                                        required
                                                        placeholder="Ex: Remote/ NY, New York"
                                                        class="form-input @error('location') input-error @enderror"
                                                        value="{{ old('location') }}">
                                                    @error('location')
                                                    <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label for="description" class="form-label">Description:</label>
                                                <div class="form-input-wrapper">
                                                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
                                                    @error('description')
                                                    <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label for="short_description" class="form-label">Short Description:</label>
                                                <div class="form-input-wrapper">
                                                        <textarea name="short_description" id="short_description" cols="30" rows="2">{{ old('short_description') }}</textarea>
                                                    @error('short_description')
                                                    <div class="error-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                           

                                            <div class="form-row">
                                                <label for="company" class="form-label">Company:</label>
                                                <div class="form-input-wrapper">
                                                    <select
                                                        name="company"
                                                        id="company"
                                                        required
                                                        class="form-input @error('company') input-error @enderror">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>
                                                            {{ $company->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    @error('company')
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