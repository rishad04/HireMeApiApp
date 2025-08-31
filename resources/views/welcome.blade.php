@extends('backend.partials.master2')

@section('container')

    <div class="container-fluid">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">

                <!-- /Logo -->
                <h4 class="mb-2">Welcome to Hireme! 👋</h4>

                <form id="formAuthentication" class="mb-3" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email or Username</label>
                        <input
                            type="text"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email or username"
                            autofocus
                        />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="••••••••••••"
                                aria-describedby="password"
                            />
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-6">

                        <form id="formAuthentication" class="mb-3" action="{{ route('admin.demo.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Demo Login As Admin</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">

                        <form id="formAuthentication" class="mb-3" action="{{ route('recruiter.demo.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Demo Login As Recruiter</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection
